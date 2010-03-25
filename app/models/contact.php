<?php
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
		
		$contains = am(array(
				'ContactType'=>array('Field'),
				'Group',
				'ParentAffiliation',
				'ChildAffiliation'
			),$plugin_types);
					
		return $this->find('first',array(
			'contain'=>$contains ,
			'conditions' => array('Contact.id' => $id),
			 'limit'=>1
		));
	}

	
	
	public function generateRecord($contact,$plugins){
		$values=array();
		$data = array();
		#$plugins = array_values($plugins);
		//FIXME this is not working 
		foreach ($plugins as $column_name => $type){
			// $data['column'][] = $column_name;
			#$data['data'] =  am($data['data',])$contact[$type];
		}//plugin
		// 
		// foreach ($data as $test=>$key) {
		// 	foreach ($key as $value) {
		// 		$values ['id'] =  $value['contact_id']; 				
		// 		$values ['record'][] = $value; 
		// 	}
		// }
		return !empty($values) ? $values : $data;
	}

	
	
	public function generateEditRecord($contact,$plugins){
		$values=array();	
		foreach ($plugins as $column_name => $type){
			foreach($contact[$type] as $tuple){
				$values[$column_name] = array(
					'data'		=>	$tuple['data'],
				 	'plugin' 	=>	$type,
				 	'test' => $tuple, 
				 );
			}					
		}//plugin
		return !empty($values) ? $values : false;
	}

}
?>