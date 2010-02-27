<?php
class Affiliation extends AppModel {

	public $name = 'Affiliation';
	
	public $actsAs = array('Containable');
			
	public $belongsTo = array(
		'FatherContactType' => array(
			'className' => 'ContactType', 
			'foreignKey' => 'contact_type_father_id'
		),
		'ChildContactType'=>array(
			'className' =>'ContactType',
			'foreignKey' => 'contact_type_child_id'
		)
	);
	
	public $hasMany = array(
		'Contact' => array(
			'className' => 'Contact', 
			'foreignKey' => 'affiliation_id'
		)
	);
	

}
?>