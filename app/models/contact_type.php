<?php
class ContactType extends AppModel {

	public $name = 'ContactType';
	
	public $actsAs=array('Containable');

	public $hasMany = array(
		'Implementation' => array(
			'className' => 'Implementation', 
			'foreignKey' => 'implementaion_id'
		));
	
}
?>