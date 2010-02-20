<?php 
/* SVN FILE: $Id$ */
/* FieldType Test cases generated on: 2010-02-20 18:11:33 : 1266689493*/
App::import('Model', 'FieldType');

class FieldTypeTestCase extends CakeTestCase {
	var $FieldType = null;
	var $fixtures = array('app.field_type');

	function startTest() {
		$this->FieldType =& ClassRegistry::init('FieldType');
	}

	function testFieldTypeInstance() {
		$this->assertTrue(is_a($this->FieldType, 'FieldType'));
	}

	function testFieldTypeFind() {
		$this->FieldType->recursive = -1;
		$results = $this->FieldType->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('FieldType' => array(
			'class_name' => 'Lorem ipsum dolor sit amet',
			'nice_name' => 'Lorem ipsum dolor sit amet'
		));
		$this->assertEqual($results, $expected);
	}
}
?>