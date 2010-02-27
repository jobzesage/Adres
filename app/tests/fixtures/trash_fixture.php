<?php 
/* SVN FILE: $Id$ */
/* Trash Fixture generated on: 2010-02-26 08:21:38 : 1267172498*/

class TrashFixture extends CakeTestFixture {
	var $name = 'Trash';
	var $table = 'trashes';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'created' => array('type'=>'datetime', 'null' => false, 'default' => NULL),
		'contact_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'description' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 45),
		'user_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id' => 1,
		'created' => '2010-02-26 08:21:38',
		'contact_id' => 1,
		'description' => 'Lorem ipsum dolor sit amet',
		'user_id' => 1
	));
}
?>