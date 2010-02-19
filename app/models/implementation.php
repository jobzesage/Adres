<?php


class Implementation extends AppModel {
	
	public $name = 'Implementation';

	public $actsAs=array('Containable');
	
	
	public $validate = array(
		'name'=>array(
			'notEmpty'=>array(
				'rule'=>'notEmpty',
				'message'=>'Implementation name can not be empty'
			)
		)
	);
	
	
}
?>