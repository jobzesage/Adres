<?php 
/* SVN FILE: $Id$ */
/* Form Fixture generated on: 2010-02-26 11:37:56 : 1267184276*/

class FormFixture extends CakeTestFixture {
	var $name = 'Form';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'title' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 45),
		'beforeHtml' => array('type'=>'text', 'null' => false, 'default' => NULL),
		'afterHtml' => array('type'=>'text', 'null' => false, 'default' => NULL),
		'admin_approval' => array('type'=>'boolean', 'null' => false, 'default' => NULL),
		'contact_type_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id' => 1,
		'title' => 'Lorem ipsum dolor sit amet',
		'beforeHtml' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
		'afterHtml' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
		'admin_approval' => 1,
		'contact_type_id' => 1
	));
}
?>