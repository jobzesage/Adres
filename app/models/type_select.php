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
	
		
}
?>