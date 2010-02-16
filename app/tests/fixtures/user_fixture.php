<?php 
/* SVN FILE: $Id$ */
/* User Fixture generated on: 2010-02-16 18:26:47 : 1266344807*/

class UserFixture extends CakeTestFixture {
	var $name = 'User';
	var $table = 'users';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'first_name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'last_name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'username' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'email' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'password' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 40),
		'is_active' => array('type'=>'boolean', 'null' => false, 'default' => NULL),
		'created' => array('type'=>'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id' => 1,
		'first_name' => 'Lorem ipsum dolor sit amet',
		'last_name' => 'Lorem ipsum dolor sit amet',
		'username' => 'Lorem ipsum dolor sit amet',
		'email' => 'Lorem ipsum dolor sit amet',
		'password' => 'Lorem ipsum dolor sit amet',
		'is_active' => 1,
		'created' => '2010-02-16 18:26:47',
		'modified' => '2010-02-16 18:26:47'
	));
}
?>