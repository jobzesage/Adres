<?php  
class TypeString extends AppModel {
	
	public $actsAs=array('Containable');
	
	public $useTable='type_string';
	
	//public $belongsTo = array('Field' => array('className' => 'Field', 'foreignKey' => 'field_id'));
}
?>