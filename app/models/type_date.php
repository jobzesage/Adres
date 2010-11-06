<?php  

App::import('Model','Plugin');

class TypeDate extends Plugin{
	
	public $useTable = 'type_date';
	
	public $optionsClass = 'TypeSelectOption';

	public function after($key,$record=array()){
		$value = $record[$key];
		

		$keys = array_keys($record);
		$values = array_values($value);
		$new_value = date('d-M-y',strtotime($values[0]));
		$value = array($keys[0]=>$new_value);
		return $value;
	}
	
	/**
	 * 
	 *
	 * @param string $field_id  
	 * @param string $column_name ie "Name" , "Age" 
	 * @param mixed $value gets the data through the inputs 
	 * @return string  the sql nested query
	 * @author Rajib
	 */
	public function processAdvancedSearch($field_id,$column_name, $value)
	{
		$query_string = array();
		if(!empty($value['to']) && !empty($value['from'])){
			
			$query_string['sql'] =$this->name.'_'.$field_id .'.'.$this->getJoinContact().' IN 
			(SELECT '.$this->getJoinContact().' 
			FROM '.$this->useTable .' as t 
			WHERE t.'.$this->getDisplayFieldName().' 
			BETWEEN \''.$value['from'].'\' AND \''.$value['to'].'\' AND t.field_id = '.(int) $field_id. ' )';
			
			$query_string['name'] = $column_name." from ".$value['from']." and ".$value['to'];
		}
		
		return $query_string;
	}
	
	
	public function advanceSearchFormField($field,$options=array())
	{
		$defaults = array('tag'=>'div','class'=>'text input');
		$wrapper = am($defaults,$options);
		
		//CSS style for a input field
		$input_style =' class="input text date_time ui-corner-all" ';
		
		$label_from = "<{$wrapper['tag']} class='{$wrapper['class']}'>";
		$label_from .= '<label for="'.$field['Field']['name'].' from" >'.$field['Field']['name'].' from</label>';
		
		$input_field_from = '<input '.$input_style.' name="data[AdvanceSearch]['.$field['Field']['id'].'][from]" value="">';  
		
		$input_field_from.="</{$wrapper['tag']}>"; 
		$label_to = "<{$wrapper['tag']} class='{$wrapper['class']}'>";
		$label_to .= '<label for="'.$field['Field']['name'].' to" >'.$field['Field']['name'].' to</label>';
		
		$input_field_to = '<input '.$input_style.' name="data[AdvanceSearch]['.$field['Field']['id'].'][to]" value="">';  
		
		$input_field_to.="</{$wrapper['tag']}>"; 

		//generates the 2 input field form
		$output = $label_from.$input_field_from.$label_to.$input_field_to;
		
		return $output;
	}
	
	public function renderEditForm($contact_id,$plugin,$wrapper=array('tag'=>'div'))
	{	
		$data = $this->find('first',array('conditions'=>array(
				'contact_id' 	=> $contact_id,
				'field_id'		=>$plugin['Field']['id'] 	
			)));
			
		$data 	= $data[$this->name][$this->getDisplayFieldName()];
		$label 	= '<'.$wrapper['tag'].' class="input text">';
		$label .='<label for="'.$plugin['Field']['name'].'">'.$plugin['Field']['name'];
		
		$label .= (int)$plugin['Field']['required'] ? " * " : "" ;
		$label .= '</label>';
		
		$output  = '<input ';
		
		$output .= (int)$plugin['Field']['required'] ? " class ='required date_time text   ui-corner-all' " : " class='text date_time   ui-corner-all'" ; # for jquery validtion
		$output .= 'name="data['.$this->getJoinField().']['.$plugin['Field']['id'].']"';
		$output .= ' value="'.$data.'"';
		$output .='/>';
		$output .='</'.$wrapper['tag'].'>';

		return  $label.$output;		
	}
	
		
}
?>