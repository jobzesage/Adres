<?php  


class TypeInteger extends AppModel {
	
	public $actsAs=array('Containable');
	
	public $useTable='type_integer';
	
	public $belongsTo =array( 'Field' => array(
			'className' => 'Field', 
			'foreignKey' => 'field_id'
	));
}
?>