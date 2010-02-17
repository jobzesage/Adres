<?php 
/* SVN FILE: $Id$ */
/* ContactTypesController Test cases generated on: 2010-02-17 18:33:58 : 1266431638*/
App::import('Controller', 'ContactTypes');

class TestContactTypes extends ContactTypesController {
	var $autoRender = false;
}

class ContactTypesControllerTest extends CakeTestCase {
	var $ContactTypes = null;

	function startTest() {
		$this->ContactTypes = new TestContactTypes();
		$this->ContactTypes->constructClasses();
	}

	function testContactTypesControllerInstance() {
		$this->assertTrue(is_a($this->ContactTypes, 'ContactTypesController'));
	}

	function endTest() {
		unset($this->ContactTypes);
	}
}
?>