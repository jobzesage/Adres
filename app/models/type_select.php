<?php  
App::import('Model','Plugin');

class TypeSelect extends Plugin {
	
	public $useTable='type_select';
	
	public $optionsClass = 'TypeSelectOption';
	
	public function renderEditForm($contact_id,$plugin,$options=array()){
		$params = array();
		$params['field_id'] = $plugin['Field']['id'];
		$params['contact_type_id'] = $_SESSION['Contact']['contact_type_id'];
		return ClassRegistry::init($this->optionsClass)->displayOptions($params);
	}
	
	public function renderShowDetail($field_name,$value,$wrapper=array('tag'=>'td')){
		//TODO wrapper will be used to wrap this column

		$data_column = $this->getDisplayFieldName();
		$output ="";
		
		$optionsClass = ClassRegistry::init('TypeSelectOption');
		$select_data = $optionsClass->read(null,$value[$this->name][$data_column]);
		$data_field_name = $optionsClass->_data_field;
		
		$data = $select_data[$optionsClass->name][$data_field_name];
		
		if($value){
			$output.= '<th>';
			$output.= $field_name;
			$output.= " : ";
			$output.= '</th>';		
			
			$output.= '<'.$wrapper['tag'].'>';
			$output.= $data;
			$output.= '</'.$wrapper['tag'].'>';
		}
		return '<tr>'.$output.'</tr>';
	}	
		
}
?>