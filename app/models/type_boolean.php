<?php  
App::import('Model','Plugin');

class TypeBoolean extends Plugin{
	
	public $actsAs=array('Containable');
	
	public $useTable='type_boolean';
	
	
	public function processEditForm($params){
		extract($params);
		
		if (empty($params['form']['field_id'])) {
			$this->_input = 0;
			$this->_field_id = $params['field_id'];

			$condition =  array(
				'contact_id'	=>$contact_id,
				'field_id'		=>$this->_field_id	
			);					
			$value = $this->find('first',array(
				'conditions' =>$condition	
			));
		
			$data_column = ClassRegistry::init($className)->getDisplayFieldName();
			$old_data = $value[$className][$data_column];
		
			$this->updateAll(array($this->getDisplayFieldName() => 0),array(
				$this->getJoinField() => $this->_field_id,
				$this->getJoinContact() => $params['contact_id']
			));		
		
			if($this->_input!==$old_data && $old_data !=''){
				$logs[]= array(
					'log_dt'		=>date(AppModel::SQL_DTF),
					'contact_id'	=>$contact_id,				
					'description' 	=>"Changed <strong>$field_name</strong> from <i>1</i> to <i>0</i>" ,
					'user_id'		=>$user_id 
				);
			}			
				
		 	if(!empty($logs)){
				ClassRegistry::init('Log')->saveAll($logs);
			}				
			
		}else{
			parent::processEditForm($params);
		}
		
	}
	

	public function processAdvancedSearch($field_id,$column_name, $value)
	{
		$query_string['sql'] =$this->name.'_'.$field_id .'.'.$this->getJoinContact().' IN (SELECT '.$this->getJoinContact().' FROM '.$this->useTable .' as t WHERE t.'.$this->getDisplayFieldName().' LIKE "%'.$value.'%" AND t.field_id = '.(int) $field_id. ' )';
		$query_string['name'] = $column_name." like ".$value;
		
		return $query_string;
	}
	
	
	public function advanceSearchFormField($field,$options=array())
	{
		$defaults = array('tag'=>'div','class'=>'text input');
		$wrapper = am($defaults,$options);
		
		//CSS style for a input field
		$input_style =' class="text span-5 " ';

		$label = "<{$wrapper['tag']} class='{$wrapper['class']}'>";
		$label.= '<label class="cbox" for="'.$field['Field']['name'].'" >'.$field['Field']['name'].'</label>';
		
		$input = '<input class="testy" type="checkbox"'.$input_style.' name="data[AdvanceSearch]['.$field['Field']['id'].']" value="1">';  
		
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
		$label 	= '<'.$wrapper['tag'].' class="input text check-box">';
		$label .='<label class="cbox" for="'.$plugin['Field']['name'].'">'.$plugin['Field']['name'];
		
		$label .= (int)$plugin['Field']['required'] ? " * " : "" ;
		$label .= '</label>';
		
		$input_check  = '<input type="checkbox" ';
		
		$input_check.= 'name="data['.$this->getJoinField().']['.$plugin['Field']['id'].']"';
		$input_check.= (bool) $data ? " checked " : "";
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