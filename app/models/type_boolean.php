<?php  
App::import('Model','Plugin');

class TypeBoolean extends Plugin{
	
	public $actsAs=array('Containable');
	
	public $useTable='type_boolean';
	
	
	public function processEditForm($data,$fields,$user_id=null)
	{
		$valid = true;
		$contact_id = $data['contact_id'];
		unset($data['contact_id']);
		unset($data['_Token']); #CSRF attack checker
		
		$logs=array();
		if(!isset($data['field_id']))
		{
			$data = $data['field_id_'];	
		}else{
			
			$data = $data['field_id'];
		}
		
		foreach ($fields as $field) {
			$field_name = $field['Field']['name'];
			$className = $field['Field']['field_type_class_name'];
			
			foreach ($data as $field_id => $input){
				if($field['Field']['id']==$field_id){
					
					$data_column = ClassRegistry::init($className)->getDisplayFieldName();
					$old_data = $value[$className][$data_column];
					if($input!==$old_data && $old_data !="")
					{
						$logs[]= array(
							'log_dt'		=>date(AppModel::SQL_DTF),
							'contact_id'	=>$contact_id,				
							'description' 	=>"Changed <strong>$field_name</strong> from <i>$old_data</i> to <i>$input</i>" ,
							'user_id'		=>$user_id 
						);
					}
					if($input!=""){
						$value[$className][$data_column] = 1;
						ClassRegistry::init($className)->updateAll(array($data_column =>'\''.$input.'\''),$condition);
					}else{
						$value[$className][$data_column] = 0;
						ClassRegistry::init($className)->updateAll(array($data_column =>'\''.$input.'\''),$condition);						
					}
				}
			}//data foreach			
		}//plugin foreach
		
		if(!empty($logs)){
			ClassRegistry::init('Log')->saveAll($logs);
		}
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
		$input_style =' class="text span-5 " ';

		$label = "<{$wrapper['tag']} class='{$wrapper['class']}'>";
		$label.= '<label for="'.$field['Field']['name'].' to" >'.$field['Field']['name'].' to</label>';
		
		$input = '<input type="checkbox" '.$input_style.' name="data[AdvanceSearch]['.$field['Field']['id'].'][to]" value="1">';  
		
		$input.="</{$wrapper['tag']}>"; 

		//generates the 2 input field form
		$output = $label.$input;
		
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
		
		$input_check  = '<input type="checkbox" ';
		
		$input_check.= 'name="data['.$this->getJoinField().']['.$plugin['Field']['id'].']"';
		$input_check.= ' value="1"';
		$input_check.='/>';
		$input_check.='</'.$wrapper['tag'].'>';
		
		$input_hidden = '<input type="hidden" ';
		$input_hidden.= 'name="data['.$this->getJoinField().'_]['.$plugin['Field']['id'].']"';
		$input_hidden.= ' value="0"';
		$input_hidden.= " >";
		
		return  $label.$input_check.$input_hidden;		
	}

}
?>