<?php  
require_once 'type_date_helper.php';

App::import('Model','TypeDate');


class TypeBirthdate extends TypeDate{
	
	public $optionsClass = 'TypeDateOption';


	
	
	public function processAdvancedSearch($field_id,$column_name, $value)
	{
		$query_string = array();
		if(!empty($value)){
			
			$query_string['sql'] =$this->name.'_'.$field_id .'.'.$this->getJoinContact().' IN 
			(select virtual.contact_id from (
			SELECT contact_id, DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(data)), \'%Y\')+0 AS age
			FROM '.$this->useTable .' as t 
			WHERE t.field_id = \''.(int) $field_id. '\' 
			HAVING age >=\''. (int) $value['from'].'\' AND age < \''.(int) $value['to'].'\'
			) virtual)';
			
			//Example query 
			// (SELECT sq.contact_id from (
				//SELECT contact_id, DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(data)), '%Y')+0 AS age FROM type_date as t 
				//WHERE t.field_id = 30 ) sq ) 
			
			$query_string['name'] = $column_name." between ".$value['from']."-".$value["to"];
		}
		
		return $query_string;
	}
}

