<?php 
/* SVN FILE: $Id$ */
/* Form Test cases generated on: 2010-02-26 11:37:56 : 1267184276*/
App::import('Model', 'Form');

class FormTestCase extends CakeTestCase {
	var $Form = null;
	var $fixtures = array('app.form');

	function startTest() {
		$this->Form =& ClassRegistry::init('Form');
	}

	function testFormInstance() {
		$this->assertTrue(is_a($this->Form, 'Form'));
	}

	function testFormFind() {
		$this->Form->recursive = -1;
		$results = $this->Form->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Form' => array(
			'id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'beforeHtml' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'afterHtml' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'admin_approval' => 1,
			'contact_type_id' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>