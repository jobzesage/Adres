<?php  
require_once 'type_date_helper.php';
App::import('Model','Plugin');

class TypeDate extends Plugin{
	
	public $useTable = 'type_date';
	
	protected $_time;
    
    const EMPTY_DATE = "Not Set";
        
	public $optionsClass = 'TypeDateOption';

	public function __construct(){
		$this->_time = new AdresTimeHelper();
		parent::__construct();
	}
	
	
	public function after(Array $dataum){
		$dates = $_SESSION['Contact']['dates'];
		
		
		if(is_array($dates) && !empty($dates)){
			if(!array_key_exists($dataum['field_id'],$dates)){
				$formatted_result = ClassRegistry::init('TypeDateOption')->getField($dataum);
				$_SESSION['Contact']['dates'][$formatted_result[0]['TypeDateOption']['field_id']]=$formatted_result[0]['TypeDateOption'];
			}
		}else{
			$formatted_result = ClassRegistry::init('TypeDateOption')->getField($dataum);
			$_SESSION['Contact']['dates'][$formatted_result[0]['TypeDateOption']['field_id']]=$formatted_result[0]['TypeDateOption'];
		}
		
		$date = array_values($dataum['data']);
		
        $output= self::EMPTY_DATE;
		
		$date_format = $_SESSION['Contact']['dates'][$dataum['field_id']]['format'];
		
		if(empty($date_format)){
			$date_format="d.m.y";
		}
		
		$date_stamp = strtotime($date[0]);
		
		
		if(!empty($date[0]) && $date_stamp){
			$output = date($date_format, $date_stamp);
     	}
		
     	
		$key = array_keys($dataum['data']);
		
		return array($key[0]=>$output);
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
		
		if(!strtotime($data)){
			$data = "";
		}
		
		$output .= ' value="'.$data.'"';
		$output .='/>';
		$output .='</'.$wrapper['tag'].'>';

		return  $label.$output;		
	}


	public function renderShowDetail($field_name,$value,$wrapper=array('tag'=>'td')){
		$data_column = $this->getDisplayFieldName();
		$output ="";
		
		$optionsClass = ClassRegistry::init($this->optionsClass);
		$select_data = $optionsClass->find('first',array(
			'contact_type_id'=>$_SESSION['Contact']['contact_type_id'],
			'field_id'=>$value[$this->name]['field_id']
		));
		
		$data_field_name = $optionsClass->_data_field;
		$data = $select_data[$optionsClass->name][$data_field_name];
		
		
		if($value){
			$output.= '<th>';
			$output.= $field_name;
			$output.= " : ";
			$output.= '</th>';		
			$output.= '<'.$wrapper['tag'].'>';
			
			$date_value = $value[$this->name][$data_column];
			$date_stamp = strtotime($date_value);
			if($date_stamp){
				$output.= date( $_SESSION['Contact']['dates'][$value[$this->name]['field_id']]['format'], $date_stamp) ;
			}else{
				$output.="Not Set";
			}
			
			$output.= '</'.$wrapper['tag'].'>';
		}
		return '<tr>'.$output.'</tr>';
	}	
		

}