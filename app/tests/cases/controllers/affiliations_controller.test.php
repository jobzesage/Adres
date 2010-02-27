<?php 
/* SVN FILE: $Id$ */
/* AffiliationsController Test cases generated on: 2010-02-26 12:37:17 : 1267187837*/
App::import('Controller', 'Affiliations');

class TestAffiliations extends AffiliationsController {
	var $autoRender = false;
}

class AffiliationsControllerTest extends CakeTestCase {
	var $Affiliations = null;

	function startTest() {
		$this->Affiliations = new TestAffiliations();
		$this->Affiliations->constructClasses();
	}

	function testAffiliationsControllerInstance() {
		$this->assertTrue(is_a($this->Affiliations, 'AffiliationsController'));
	}

	function endTest() {
		unset($this->Affiliations);
	}
}
?>