<?php
class FieldType extends AppModel {

	public $name = 'FieldType';
	
	public $primaryKey='class_name';
	
	public $validate = array(
		'class_name'=>array(
			'isUnique'=>array(
				'rule'=>'isUnique',
				'message'=>'Same Class Name exists'
				)
			)
	);
	
	public $hasMany = array(
		'Field' => array(
			'className' => 'Field', 
			'foreignKey' => 'field_type_class_name'
			)
	);

}
?>