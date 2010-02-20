<?php
class ContactType extends AppModel {

	public $name = 'ContactType';

	public $actsAs = array('Containable');
	
	public $belongsTo = array(
		'Implementation'=>array(
			'className'=>'Implementation'
		)
	);
	
	
}
?>