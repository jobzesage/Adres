<?php 
/* SVN FILE: $Id$ */
/* Field Test cases generated on: 2010-02-20 19:27:22 : 1266694042*/
App::import('Model', 'Field');

class FieldTestCase extends CakeTestCase {
	var $Field = null;
	var $fixtures = array('app.field');

	function startTest() {
		$this->Field =& ClassRegistry::init('Field');
	}

	function testFieldInstance() {
		$this->assertTrue(is_a($this->Field, 'Field'));
	}

	function testFieldFind() {
		$this->Field->recursive = -1;
		$results = $this->Field->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Field' => array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'contact_type__id' => 1,
			'order' => 1,
			'field_type_class_name' => 'Lorem ipsum dolor sit amet',
			'is_descriptive' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>