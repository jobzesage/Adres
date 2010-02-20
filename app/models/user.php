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

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
/*	var $hasMany = array(
		'Log' => array(
			'className' => 'Log',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
*/
}
?>