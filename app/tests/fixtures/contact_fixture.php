<?php 
/* SVN FILE: $Id$ */
/* Contact Fixture generated on: 2010-02-19 19:55:36 : 1266609336*/

class ContactFixture extends CakeTestFixture {
	var $name = 'Contact';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'contact_type_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'trash_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'created' => array('type'=>'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id' => 1,
		'contact_type_id' => 1,
		'trash_id' => 1,
		'created' => '2010-02-19 19:55:36',
		'modified' => '2010-02-19 19:55:36'
	));
}
?>