<?php  
class TypeString extends AppModel {
	
	public $actsAs=array('Containable');
	
	public $useTable='type_string';
	
	public $belongsTo = array(
		'Field' => array(
			'className' => 'Field', 
			'foreignKey' => 'field_id',
			'joins'=>array(
				array(
		            'table' => 'type_string',
		            'alias' => 'TypeString',
		            'type' => 'Left',
		            #'foreignKey' => '',
		            'conditions'=> array('TypeString.field_id = Field.id')
		        )				
			)
	));
	
}
?>