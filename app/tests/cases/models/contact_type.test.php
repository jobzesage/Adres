<?php 
/* SVN FILE: $Id$ */
/* ContactType Test cases generated on: 2010-02-17 18:32:25 : 1266431545*/
App::import('Model', 'ContactType');

class ContactTypeTestCase extends CakeTestCase {
	var $ContactType = null;
	var $fixtures = array('app.contact_type');

	function startTest() {
		$this->ContactType =& ClassRegistry::init('ContactType');
	}

	function testContactTypeInstance() {
		$this->assertTrue(is_a($this->ContactType, 'ContactType'));
	}

	function testContactTypeFind() {
		$this->ContactType->recursive = -1;
		$results = $this->ContactType->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('ContactType' => array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'implementation_id' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>