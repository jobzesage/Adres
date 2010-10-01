<?php

class TypeSelectOption extends AppModel {
	
	public $name = 'TypeSelectOption';
	
	public $useTable='type_select_options';
	
	private $_data_field = 'value';
	

	public function displayOptions($params,$options=array()){
		$data = $this->find('all',array(
			'conditions' => array(
				'contact_type_id' => $params['contact_type_id'],
				'field_id'=>$params['field_id'] 
			) 
		));
		
		return $this->formatter($data,$params);
	}
	
	
	public function formatter($selects,$params){
		$output ='<select name="'.$params['field_id'].'">'."\n";
		foreach ($selects as $select) {
			$output.='<option value='.$select[$this->name]['id'].'>'.$select[$this->name][$this->_data_field].'</option>'."\n";
		}
		return $output.='</select>';	
	}
	
	public function add(){

	}
	
	public function edit(){
		
	}
	
	public function delete(){
		
		
	}
	
	public function list_view(){
		
	}
	
}
?>