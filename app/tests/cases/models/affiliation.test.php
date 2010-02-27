<?php 
/* SVN FILE: $Id$ */
/* Affiliation Test cases generated on: 2010-02-26 08:18:25 : 1267172305*/
App::import('Model', 'Affiliation');

class AffiliationTestCase extends CakeTestCase {
	var $Affiliation = null;
	var $fixtures = array('app.affiliation');

	function startTest() {
		$this->Affiliation =& ClassRegistry::init('Affiliation');
	}

	function testAffiliationInstance() {
		$this->assertTrue(is_a($this->Affiliation, 'Affiliation'));
	}

	function testAffiliationFind() {
		$this->Affiliation->recursive = -1;
		$results = $this->Affiliation->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Affiliation' => array(
			'id' => 1,
			'contact_type_father_id' => 1,
			'contact_type_child_id' => 1,
			'father_name' => 'Lorem ipsum dolor sit amet',
			'child_name' => 'Lorem ipsum dolor sit amet',
			'created' => '2010-02-26 08:18:25',
			'modified' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>