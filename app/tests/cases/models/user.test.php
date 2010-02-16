<?php 
/* SVN FILE: $Id$ */
/* User Test cases generated on: 2010-02-16 18:26:47 : 1266344807*/
App::import('Model', 'User');

class UserTestCase extends CakeTestCase {
	var $User = null;
	var $fixtures = array('app.user', 'app.log');

	function startTest() {
		$this->User =& ClassRegistry::init('User');
	}

	function testUserInstance() {
		$this->assertTrue(is_a($this->User, 'User'));
	}

	function testUserFind() {
		$this->User->recursive = -1;
		$results = $this->User->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('User' => array(
			'id' => 1,
			'first_name' => 'Lorem ipsum dolor sit amet',
			'last_name' => 'Lorem ipsum dolor sit amet',
			'username' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'is_active' => 1,
			'created' => '2010-02-16 18:26:47',
			'modified' => '2010-02-16 18:26:47'
		));
		$this->assertEqual($results, $expected);
	}
}
?>