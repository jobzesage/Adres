<?php  

App::import('Model','Plugin');

class TypeDate extends Plugin{
	
	public $useTable = 'type_date';
	
	public function getDisplayFieldName()
	{
		return $this->_display_field_name;
	}
	
	
	public function setDisplayFieldName($name)
	{
		$this->_display_field_name = $name;
	}
	
	
	public function getJoinContact()
	{
		return $this->_join_contact_name;
	}
	
	
	public function getJoinField()
	{
		return $this->_join_field_name;
	}


	public function processEditForm($data,$fields,$user_id=null)
	{
		$valid = true;
		$contact_id = $data['contact_id'];
		unset($data['contact_id']);
		unset($data['_Token']); #CSRF attack checker
		$logs=array();


		foreach ($fields as $field) {
			$field_name = $field['Field']['name'];
			$className = $field['Field']['field_type_class_name'];
			
			foreach ($data['field_id'] as $field_id => $input){
				if($field['Field']['id']==$field_id){
					
					$condition =  array(
						'contact_id'	=>$contact_id,
						'field_id'		=>$field_id	
					);					
					$value = ClassRegistry::init($className)->find('first',array(
						'conditions' =>$condition	
					));
					
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
						$value[$className][$data_column] = date(AppModel::SQL_DTF,strtotime($input));
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
		$query_string['sql'] =$this->name.'_'.$field_id .'.'.$this->getJoinContact().' IN (SELECT '.$this->getJoinContact().' FROM '.$this->useTable .' as t WHERE t.'.$this->getDisplayFieldName().' BETWEEN \''.$value['from'].'\' AND \''.$value['to'].'\' AND t.field_id = '.(int) $field_id. ' )';
		
		$query_string['name'] = $column_name." from <b>".$value['from']."</b> and <b>".$value['to']."</b>";
		
		return $query_string;
	}
	
	
	public function advanceSearchFormField($field,$options=array())
	{
		$defaults = array('tag'=>'div','class'=>'text input');
		$wrapper = am($defaults,$options);
		
		//CSS style for a input field
		$input_style =' class="text date_time span-5 ui-corner-all" ';

		
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
		
		$output .= (int)$plugin['Field']['required'] ? " class ='required date_time text span-8 ui-corner-all' " : " class='text date_time span-8 ui-corner-all'" ; # for jquery validtion
		$output .= 'name="data['.$this->getJoinField().']['.$plugin['Field']['id'].']"';
		$output .= ' value="'.$data.'"';
		$output .='/>';
		$output .='</'.$wrapper['tag'].'>';

		return  $label.$output;		
	}
	
		
}
?>