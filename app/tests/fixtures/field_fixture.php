<?php 
/* SVN FILE: $Id$ */
/* Field Fixture generated on: 2010-02-20 19:27:22 : 1266694042*/

class FieldFixture extends CakeTestFixture {
	var $name = 'Field';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 45),
		'contact_type__id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'order' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'field_type_class_name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 45),
		'is_descriptive' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id' => 1,
		'name' => 'Lorem ipsum dolor sit amet',
		'contact_type__id' => 1,
		'order' => 1,
		'field_type_class_name' => 'Lorem ipsum dolor sit amet',
		'is_descriptive' => 1
	));
}
?>