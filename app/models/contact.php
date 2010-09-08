<?php

App::import('Sanitize');

class Contact extends AppModel {

	public $actsAs = array('Containable');
	
	public $name = 'Contact';

	public $user_id = null;
	
	public $log_message = "";
	
	public $belongsTo = array(
		'ContactType',
		'ContactTrash'=>array(
			'className'=>'Trash',
			'foreignKey'=>'trash_id'
		),
		'Trash' =>array(
			'className'=>'Log',
			'foreignKey'=>false,
			'conditions'=>array(
				'Contact.trash_id=Trash.id',	
			)	
		),
		'Trasher'=>array(
			'className'=>'User',
			'foreignKey'=>false,
			'conditions'=>array(
				'Trash.user_id=Trasher.id'	
			)	
		)		
	);
			
	public $hasMany = array(
		'Log' => array(
			'className'=>'Log',
			'foreignKey' => 'contact_id',
			'order' => 'Log.log_dt ASC',
			'limit'=>5
		)
	);

	public $hasAndBelongsToMany = array(
		'Group' => array(
			'className' => 'Group', 
			'foreignKey' => 'contact_id',
			'associationForeignKey' => 'group_id',
		),
		'ParentAffiliation' => array(
			'className' => 'Affiliation', 
			'foreignKey' => 'contact_father_id',
			'associationForeignKey' => 'affiliation_id',
		),
		'ChildAffiliation' => array(
			'className' => 'Affiliation', 
			'foreignKey' => 'contact_child_id',
			'associationForeignKey' => 'affiliation_id',
		),
		'Affiliation'=>array(
			'className' => 'Affiliation', 
			'associationForeignKey' => 'affiliation_id'			
			#'foreignKey' => 'contact_child_id',
			#'associationForeignKey' => 'affiliation_id',
		)		
	);
	
	
	
	/**
	 * handles the contact delete of adres
	 *
	 * @param integer $id 
	 * @return boolean
	 * @author Rajib 
	 */	
	public function delete($id){
		
		$field_types = ClassRegistry::init('FieldType')->find('all');
		$fields = Set::extract($field_types,"/FieldType/class_name");
		foreach ($fields as $className) {
			//$this->{$className}->recursive = -1;
			ClassRegistry::init($className)->deleteAll(array('contact_id' => $id),false);
		}
		//this cascading enable HABTM delete of Group
		return parent::delete($id,true);		
	}	
	
	
	/**
	 * gets a contact by an id
	 *
	 * @param integer $id 
	 * @param array $plugin_types 
	 * @return array
	 * @author Rajib
	 */
	public function getContact($id,$plugin_types = null){
		$contains_extra=array();

		if (!empty($plugin_types)) {
			$plugin_types = array_unique(array_values($plugin_types));
			// it danamically attaches the Field Model so that data can be retrived
			foreach ($plugin_types as $type_name) {
				$contains_extra =am($contains_extra,array($type_name =>array('Field')));
			}			
		}

		$contains = array(
			'Group',
			'ParentAffiliation',
			'ChildAffiliation',
			'Log'=>array('User')
		);

		$contains = am($contains,$contains_extra);

		return $this->find('first',array(
			'contain'=>$contains ,
			'conditions' => array('Contact.id' => $id),
			'limit'=>1
		));
	}

	
	
	public function generateRecord($contact,$plugins){
		$values=array();
		$data = array();
		$plugins = array_unique($plugins);
		foreach ($plugins as $column_name => $type){
			$data[] =  $contact[$type];
		}//plugin
		
		return !empty($data) ? $data : false;
	}

	

	public function update_record($contact,$plugins){
		$contact_id = $contact['Contact']['id'];
		$classNames = array_unique(array_values($plugins));
		$this->id = $contact_id;		
		$this->save();// triggering update on contact
		
		foreach ($classNames as $className) {
			ClassRegistry::init($className)->unBindModel(array('belongsTo'=>array('Field')));
			foreach($contact[$className] as $data ){
				$field_id =array_keys($data);
				$data= array_values($data);
				$save_data = array(
					'data' => '\''.Sanitize::escape($data[0]).'\''
				);
			ClassRegistry::init($className)->updateAll($save_data,array(
					'field_id'=>$field_id[0],
					'contact_id' =>$contact_id ));				
			}
		}
	}
	
	
	
	public function save_record($contact,$plugins){
		
			if($this->save(array(
				'contact_type_id'=>$contact['Contact']['contactTypeId']
			))){
				$contact_id = $this->id;
				unset($contact['Contact']);
				foreach($contact as $key=>$value) {
					$className = $plugins[$key];
					$data = array_values($value);
					$key = array_keys($value);
					$data = array(
						'contact_id' => $contact_id,
						'field_id'=>$key[0], 
						'data'=>Sanitize::escape($data[0])
					);
					$datas[$className][]= $data;
				}	
				$classNames =array_unique(array_values($plugins));
				foreach ($classNames as $className) {
					ClassRegistry::init($className)->saveAll($datas[$className]);
				}			
			}		
	}
	
	
	
	public function leaveGroup($group_id,$contact_id){
		$this->afterSave(false); # not an inset and update command
		return $this->query(
			'DELETE FROM contacts_groups 
			WHERE group_id='. $group_id.' 
			AND contact_id='.$contact_id);
	}
	
	
	/**
	 * observer method
	 *
	 * @param boolean $created 
	 * @return void
	 * @author Rajib Ahmed
	 */	
	public function afterSave($created){
		if ($created) {
			$this->counter_cache($this->ContactType->id,1);
			 
			$this->Log->save(array(
				'log_dt'=>date(AppModel::SQL_DTF),
				'contact_id'=>$this->id,				
				'description' 	=> AppModel::CONTACT_SAVED,
				'user_id'=>$this->user_id 
			));
		}else{
                        //update section
			$this->Log->save(array(
				'log_dt'=>date(AppModel::SQL_DTF),
				'contact_id'=>$this->id,				
				'description' 	=> $this->log_message,
				'user_id'=>$this->user_id 	
			));	
		}
	}
	

	public function getContactGroups($id)
	{
		return $this->find('first',array(
			'contain'=>array('Group'),
			'conditions' => array('Contact.id' => $id),
			'limit'=>1
		));
	}

	public function getContactAffiliations($id)
	{
		$contacts = $this->find('first',array(
			'contain'=>array(
				'ParentAffiliation',
				'ChildAffiliation',				
			),
			'conditions' => array('Contact.id' => $id),
			'limit'=>1
		));
		
		$affiliations = array(
			'ParentAffiliation'=>array(
				'affiliated'=>'father_name',
				'contact_id'=>'contact_child_id'
			),
			'ChildAffiliation'=>array(
				'contact_id' => 'contact_father_id',
				'affiliated'=>'child_name'
			)
		);
		$data=array();
		$i=0;
		foreach ($affiliations as $affliation_name => $con) {
			foreach ($contacts[$affliation_name] as $value){
				$data[$i]['affiliated_contact_id']= $value['AffiliationsContact'][$con['contact_id']];
				$data[$i]['affiliation_type']=$value[$con['affiliated']];
				$i++;
			}
		}
		return $data;
	}
	
	public function getContactLogs($id)
	{
		return $this->find('first',array(
			'contain'=>array('Log'=>array('User')),
			'conditions' => array('Contact.id' => $id),
			'limit'=>1
		));
	}
	
	public function afterDelete()
	{
		$this->counter_cache($this->ContactType->id, -1);	
	}
	
	public function counter_cache($contact_type_id,$increment)
	{
		$contact_type = $this->ContactType->read(null,$contact_type_id);
		$contact_type['ContactType']['contact_counter'] = $contact_type['ContactType']['contact_counter'] + $increment ;
		$this->ContactType->save($contact_type);
	}
	
	
	public function saveAfilliation($affiliation)
	{
		$sql = 'INSERT into affiliations_contacts';
		$sql .= ' (contact_father_id,contact_child_id,affiliation_id) ';
		$sql .= ' values(\''.(int) $affiliation['contact_father_id'].'\',';
		$sql .='\''.$affiliation['contact_child_id'].'\',';
		$sql .='\''.$affiliation['affiliation_id'].'\'';
		$sql .=')';
		
		$this->query($sql);
	}
	
	
	public function findTrashed()
	{
		return $this->find('all',array(
			'contain'=>array('ContactType','Trash','Trasher'),
			'conditions'=>array(
				'Contact.trash_id !=0'	
			)	
		));
	}
	
}
?>
