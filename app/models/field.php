<?php
class Field extends AppModel {

	public $name = 'Field';
	
	public $actsAs = array('Containable');
	
	public $belongsTo = array(
		'ContactType' => array(
			'className' => 'ContactType', 
			'foreignKey' => 'contact_type_id'
		)
	);
	
	public $hasMany = array(
		'TypeString' => array(
			'className' => 'TypeString', 
			'foreignKey' => 'field_id'
		),
		'TypeInteger' => array(
			'className' => 'TypeInteger', 
			'foreignKey' => 'field_id'
		)
	);
	
	public $hasAndBelongsToMany = array(
		'Form' => array(
			'className' => 'Form', 
			'foreignKey' => 'field_id',
			'associationForeignKey' => 'form_id',
			'joinTable'=>'forms_fields'
		)
	);
	


	public function getPluginTypes($contactType){
		$fields = $this->find('all',array(
			'fields'=>array('Field.field_type_class_name'),
			'conditions' => array('Field.contact_type_id'=>$contactType ) 
		));
		
		$field_list = array();
		foreach ($fields as $plugin) {
			$className = $plugin['Field']['field_type_class_name'];
			$field_list[] = 'Type'.ucwords($className);				
		}
		return $field_list;
	}	

}
?>