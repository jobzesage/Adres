<?php
class ContactType extends AppModel {

	public $name = 'ContactType';

	public $actsAs = array('Containable');
	
	public $belongsTo = array(
		'Implementation'=>array(
			'className'=>'Implementation',
			'foreignKey'=>'implementation_id'
		)
	);
	
	public $hasMany = array(
		'FatherAffiliation' => array(
			'className' => 'Affiliation', 
			'foreignKey' => 'contact_type_father_id'
		),
		'ChildAffiliation'=>array(
			'className'=>'Affiliation',
			'foreignKey'=>'contact_type_child_id'
		),
		'Contact'=>array(
			'className'=>'Contact',
			'foreignKey'=>'contact_type_id'
		),
		'Field'=>array(
			'className'=>'Field',
			'foreignKey'=>'contact_type_id'
		),
		'Form'=>array(
			'className'=>'Form',
			'foreignKey'=>'contact_type_id'	
		)
	);
	
}
?>