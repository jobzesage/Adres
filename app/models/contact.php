<?php

App::import('Sanitize');

class Contact extends AppModel {

	public $actsAs = array('Containable');
	
	public $name = 'Contact';

	public $belongsTo = array(
		'ContactType',
		'ContactTrash'=>array(
			'className'=>'Trash',
			'foreignKey'=>'trash_id'
		)
	);
			
	public $hasMany = array(
		'TypeString' => array(
			'className' => 'TypeString', 
			'foreignKey' => 'contact_id'
		),
		'TypeInteger' => array(
			'className' => 'TypeInteger', 
			'foreignKey' => 'contact_id'
		),
		'Trash'=>array(
			'className'=>'Trash',
			'foeignKey'=>'contact_id'	
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
		)		
	);
	
	/**
	 * handles the contact delete of adres
	 *
	 * @param integer $id 
	 * @param array $plugins 
	 * @return boolean
	 * @author Rajib 
	 */	
	public function delete($id,$plugins){
		
		$plugins = array_unique(array_values($plugins));
		
		foreach ($plugins as $className) {
			$this->{$className}->recursive = -1;
			$this->{$className}->deleteAll(array('contact_id' => $id),false);
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
	public function getContact($id,$plugin_types){
		$plugin_types = array_unique(array_values($plugin_types));
		$contains_extra=array();
		foreach ($plugin_types as $type_name) {
			$contains_extra =am($contains_extra,array($type_name =>array('Field')));
		}
		$contains = array(
			'Group',
			'ParentAffiliation',
			'ChildAffiliation'
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

	

	public function update_record($plugins){
		$contact_id = $this->data['Contact']['id'];
		$classNames = array_unique(array_values($plugins));
		
		foreach ($classNames as $className) {
			ClassRegistry::init($className)->unBindModel(array('belongsTo'=>array('Field')));
			foreach($this->data[$className] as $data ){
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
}
?>