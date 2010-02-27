<?php
class Form extends AppModel {

	public $name = 'Form';
	
	public $actsAs = array('Containable');
		
	public $belongsTo = array(
		'ContactType' => array(
			'className' => 'ContactType', 
			'foreignKey' => 'contact_type_id'
		)
	);
	
	public $hasAndBelongsToMany = array(
		'Field' => array(
			'className' => 'Field', 
			'foreignKey' => 'form_id',
			'associationForeignKey' => 'field_id',
			'joinTable'=>'forms_fields'
		)
	);	

}
?>