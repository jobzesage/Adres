<?php 
/* SVN FILE: $Id$ */
/* FieldTypesController Test cases generated on: 2010-02-20 18:12:05 : 1266689525*/
App::import('Controller', 'FieldTypes');

class TestFieldTypes extends FieldTypesController {
	var $autoRender = false;
}

class FieldTypesControllerTest extends CakeTestCase {
	var $FieldTypes = null;

	function startTest() {
		$this->FieldTypes = new TestFieldTypes();
		$this->FieldTypes->constructClasses();
	}

	function testFieldTypesControllerInstance() {
		$this->assertTrue(is_a($this->FieldTypes, 'FieldTypesController'));
	}

	function endTest() {
		unset($this->FieldTypes);
	}
}
?>