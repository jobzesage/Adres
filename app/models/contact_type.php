<?php
class ContactType extends AppModel {

	public $name = 'ContactType';
	
	public $belongsTo = array(
		'Implementation'=>array(
			'className'=>'Implementation'
		)
	);
	
	
}
?>