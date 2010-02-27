<?php 
/* SVN FILE: $Id$ */
/* Trash Test cases generated on: 2010-02-26 08:21:38 : 1267172498*/
App::import('Model', 'Trash');

class TrashTestCase extends CakeTestCase {
	var $Trash = null;
	var $fixtures = array('app.trash');

	function startTest() {
		$this->Trash =& ClassRegistry::init('Trash');
	}

	function testTrashInstance() {
		$this->assertTrue(is_a($this->Trash, 'Trash'));
	}

	function testTrashFind() {
		$this->Trash->recursive = -1;
		$results = $this->Trash->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Trash' => array(
			'id' => 1,
			'created' => '2010-02-26 08:21:38',
			'contact_id' => 1,
			'description' => 'Lorem ipsum dolor sit amet',
			'user_id' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>