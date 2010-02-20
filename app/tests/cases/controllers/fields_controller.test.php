<?php 
/* SVN FILE: $Id$ */
/* FieldsController Test cases generated on: 2010-02-20 19:30:55 : 1266694255*/
App::import('Controller', 'Fields');

class TestFields extends FieldsController {
	var $autoRender = false;
}

class FieldsControllerTest extends CakeTestCase {
	var $Fields = null;

	function startTest() {
		$this->Fields = new TestFields();
		$this->Fields->constructClasses();
	}

	function testFieldsControllerInstance() {
		$this->assertTrue(is_a($this->Fields, 'FieldsController'));
	}

	function endTest() {
		unset($this->Fields);
	}
}
?>