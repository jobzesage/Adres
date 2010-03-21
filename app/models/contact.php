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
}
?>