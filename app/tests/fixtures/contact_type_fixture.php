<?php 
/* SVN FILE: $Id$ */
/* ContactType Fixture generated on: 2010-02-17 18:32:25 : 1266431545*/

class ContactTypeFixture extends CakeTestFixture {
	var $name = 'ContactType';
	var $table = 'contact_types';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 45),
		'implementation_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id' => 1,
		'name' => 'Lorem ipsum dolor sit amet',
		'implementation_id' => 1
	));
}
?>