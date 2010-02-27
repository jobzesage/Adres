<?php
class Contact extends AppModel {

	public $actsAs = array('Containable');
	
	public $name = 'Contact';

	public $belongsTo = array(
		'ContactType' => array(
			'className' => 'ContactType', 
			#'foreignKey' => 'contact_id'
		),
		'ContactTrash'=>array(
			'className'=>'Trash',
			'foreignKey'=>'trash_id'
		)
	);
			
	public $hasMany = array(
		'TypeString' => array(
			'className' => 'TypeString', 
			'foreignKey' => 'contact_id'
		),
		'Trash'=>array(
			'className'=>'Trash',
			'foeignKey'=>'contact_id'	
		)
	);

	public $hasAndBelongsToMany = array(
		'Group' => array(
			'className' => 'Group', 
			'foreignKey' => 'contact_id',
			'associationForeignKey' => 'group_id',
		)
	);
	
}
?>