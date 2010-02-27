<?php 
/* SVN FILE: $Id$ */
/* Affiliation Fixture generated on: 2010-02-26 08:18:25 : 1267172305*/

class AffiliationFixture extends CakeTestFixture {
	var $name = 'Affiliation';
	var $table = 'affiliations';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'contact_type_father_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'contact_type_child_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'father_name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'child_name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'created' => array('type'=>'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id' => 1,
		'contact_type_father_id' => 1,
		'contact_type_child_id' => 1,
		'father_name' => 'Lorem ipsum dolor sit amet',
		'child_name' => 'Lorem ipsum dolor sit amet',
		'created' => '2010-02-26 08:18:25',
		'modified' => 1
	));
}
?>