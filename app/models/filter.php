<?php


class Filter extends AppModel {

	public $actsAs = array('Containable');
    
	public $name = 'Filter';
    
	public $belongsTo = array(
		'ContactType' => array(
			'className' => 'ContactType', 
			'foreignKey' => 'contact_type_id'
		));





}
?>
