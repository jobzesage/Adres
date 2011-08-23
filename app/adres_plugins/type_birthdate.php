<?php  

App::import('Model','TypeDate');

/**
* 
*/
class TypeBirthdate extends TypeDate{
	
	public $optionsClass = 'TypeDateOption';
	
	public function __construct()
	{
		$this->optionsClass = 'TypeDateOption';
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

}

