<?php

require_once 'plugin.php';

class TypeText extends Plugin
{

  
	public $useTable = 'type_text';
    
    public function renderEditForm($contact_id,$plugin,$wrapper=array('tag'=>'div')){	
		
		$data = $this->find('first',array('conditions'=>array(
				'contact_id' 	=> $contact_id,
				'field_id'		=>$plugin['Field']['id'] 	
			)));
			
		$data 	= $data[$this->name][$this->getDisplayFieldName()];
		
		$label 	= '<'.$wrapper['tag'].' class="input text">';
		$label .='<label for="'.$plugin['Field']['name'].'">'.$plugin['Field']['name'];
		
		$label .= (int)$plugin['Field']['required'] ? " * " : "" ;
		$label .= '</label>';
		
		$output  = '<textarea ';
		
		$output .= (int)$plugin['Field']['required'] ? " class ='required area text ui-corner-all' " : " class='text area ui-corner-all'" ; # for jquery validtion
		$output .= 'name="data['.$this->getJoinField().']['.$plugin['Field']['id'].']"';
		$output .='>'.$data.'</textarea>';
		$output .='</'.$wrapper['tag'].'>';

		return $label.$output;		
    }

	public function advanceSearchFormField($field,$options=array()){
		return ""; //no searching for textarea right now will slow down the system
	}
}




