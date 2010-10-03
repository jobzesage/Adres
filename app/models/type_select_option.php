<?php

class TypeSelectOption extends AppModel {
	
	public $name = 'TypeSelectOption';
	
	public $useTable='type_select_options';
	
	public $_data_field = 'value';
	

	private function getField($params){
		return $this->find('all',array(
			'conditions' => array(
				'contact_type_id' => $params['contact_type_id'],
				'field_id'=>$params['field_id'] 
			) 
		));
		
	}
	
	public function displayOptions($params)
	{
		$field = $this->getField($params);
		return $this->formatter($field,$params);
	}
	
	public function formatter($selects,$params){
		$field = ClassRegistry::init('Field')->read(null,$params['field_id']);
		
		$label= '<div class="input text">
				<label for="'.$field['Field']['name'].'">'.$field['Field']['name'].'</label>';
		
		$output ='<select name="data[field_id]['.$params['field_id'].']">'."\n";
		foreach ($selects as $select) {
			$output.='<option value='.$select[$this->name]['id'].'>'.$select[$this->name][$this->_data_field].'</option>'."\n";
		}
		return $label.$output.='</select></div>';	
	}
	
	
	
	public function add($params){
		$field = $this->getField($params);
		$output  = '<input type="hidden" name="data[contact_type_id]" value="'.$params['contact_type_id'].'"]>';	
		$output .= '<input type="hidden" name="data[field_id]" value="'.$params['field_id'].'">';	
		$output .= '<input type="text" name="data['.$this->_data_field.']">';
		return $output;
	}
	
	public function processAdd($form_data){
		$this->save($form_data);
	}	
	
	public function edit(){
		
	}
	
	public function delete(){
		
		
	}
	
	public function list_view(){
		
	}
	
	public function getLinks($params){
		
	}
	
}
?>