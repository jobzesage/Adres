<?php  


class TypeInteger extends AppModel {
	
	public $actsAs=array('Containable');
	
	public $useTable='type_integer';
	
	public $belongsTo =array( 'Field' => array(
			'className' => 'Field', 
			'foreignKey' => 'field_id',
			'joins'=>array(
				array(
		            'table' => 'type_integer',
		            'alias' => 'TypeInteger',
		            'type' => 'Left',
		            #'foreignKey' => false,
		            'conditions'=> array('TypeInteger.field_id = Field.id')
		        )				
			)
	));
}
?>