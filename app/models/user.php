<?php
class User extends AppModel {

	public $name = 'User';

	public $actsAs = array('Containable');
	
	public $validate = array(
		'first_name' => array('notempty'),
		'last_name' => array('notempty'),
		'username' => array('notempty'),
		'email' => array('email'),
		'password' => array('notempty'),
		'is_active' => array('numeric')
	);
	

	public $hasMany = array(
		'Log' => array(
			'className' => 'Trash',
			'foreignKey' => 'user_id'
		)
	);
}
?>