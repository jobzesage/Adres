<?php 
/* SVN FILE: $Id$ */
/* Contact Test cases generated on: 2010-02-19 19:55:36 : 1266609336*/
App::import('Model', 'Contact');

class ContactTestCase extends CakeTestCase {
	var $Contact = null;
	var $fixtures = array('app.contact');

	function startTest() {
		$this->Contact =& ClassRegistry::init('Contact');
	}

	function testContactInstance() {
		$this->assertTrue(is_a($this->Contact, 'Contact'));
	}

	function testContactFind() {
		$this->Contact->recursive = -1;
		$results = $this->Contact->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Contact' => array(
			'id' => 1,
			'contact_type_id' => 1,
			'trash_id' => 1,
			'created' => '2010-02-19 19:55:36',
			'modified' => '2010-02-19 19:55:36'
		));
		$this->assertEqual($results, $expected);
	}
}
?>