<?php
class Field extends AppModel {

	public $name = 'Field';
	
	public $actsAs = array('Containable');
	
	public $belongsTo = array(
		'ContactType' => array(
			'className' => 'ContactType', 
			'foreignKey' => 'contact_type_id'
		),
		'StringPlugin'=>array(
			'className'=>'TypeString',
			'foreignKey'=>'fld_flt_class_name'
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
	
	// public $hasMany = array(
	// 	'TypeString' => array(
	// 		'className' => 'TypeString', 
	// 		'foreignKey' => 'field_id'
	// ));
}
?>