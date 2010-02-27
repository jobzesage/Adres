<?php 
/* SVN FILE: $Id$ */
/* FormsField Fixture generated on: 2010-02-26 10:37:36 : 1267180656*/

class FormsFieldFixture extends CakeTestFixture {
	var $name = 'FormsField';
	var $table = 'forms_fields';
	var $fields = array(
		'form_id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'field_id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'default_value' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 45),
		'is_visible' => array('type'=>'boolean', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => array('form_id', 'field_id'), 'unique' => 1))
	);
	var $records = array(array(
		'form_id' => 1,
		'field_id' => 1,
		'default_value' => 'Lorem ipsum dolor sit amet',
		'is_visible' => 1
	));
}
?>