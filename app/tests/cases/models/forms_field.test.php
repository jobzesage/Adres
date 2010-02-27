<?php 
/* SVN FILE: $Id$ */
/* FormsField Test cases generated on: 2010-02-26 10:37:36 : 1267180656*/
App::import('Model', 'FormsField');

class FormsFieldTestCase extends CakeTestCase {
	var $FormsField = null;
	var $fixtures = array('app.forms_field');

	function startTest() {
		$this->FormsField =& ClassRegistry::init('FormsField');
	}

	function testFormsFieldInstance() {
		$this->assertTrue(is_a($this->FormsField, 'FormsField'));
	}

	function testFormsFieldFind() {
		$this->FormsField->recursive = -1;
		$results = $this->FormsField->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('FormsField' => array(
			'form_id' => 1,
			'field_id' => 1,
			'default_value' => 'Lorem ipsum dolor sit amet',
			'is_visible' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>