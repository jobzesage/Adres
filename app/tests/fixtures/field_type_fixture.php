<?php 
/* SVN FILE: $Id$ */
/* FieldType Fixture generated on: 2010-02-20 18:11:33 : 1266689493*/

class FieldTypeFixture extends CakeTestFixture {
	var $name = 'FieldType';
	var $table = 'field_types';
	var $fields = array(
		'class_name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 45, 'key' => 'primary'),
		'nice_name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 45),
		'indexes' => array('PRIMARY' => array('column' => 'class_name', 'unique' => 1))
	);
	var $records = array(array(
		'class_name' => 'Lorem ipsum dolor sit amet',
		'nice_name' => 'Lorem ipsum dolor sit amet'
	));
}
?>