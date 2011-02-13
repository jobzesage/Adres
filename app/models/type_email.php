<?php  
App::import('Model','Plugin');

class TypeEmail extends Plugin{
    public $useTable = 'type_email';     

    public $validate = array(
        'data'=>'email'
    );

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
		
		$output  = '<input ';
		
		$output .= (int)$plugin['Field']['required'] ? " class ='required  text ui-corner-all' " : " class='text ui-corner-all'" ; # for jquery validtion
		$output .= 'name="data['.$this->getJoinField().']['.$plugin['Field']['id'].']"';
		$output .= ' value="'.$data.'"';
		$output .='/>';
		$output .='</'.$wrapper['tag'].'>';

		return $label.$output;		
    }


	public function processEditForm($options)
	{
		extract($options);
		
		if(!empty($field_id)){
			$this->_field_id = $field_id;
		}
		
		//iterate through dataset
		if(!isset($this->_input)){
			$this->_setInputData($form);
		}
		
		$condition =  array(
			'contact_id'	=>$contact_id,
			'field_id'		=>$this->_field_id	
		);					
		$value = $this->find('first',array(
			'conditions' =>$condition	
		));
		
		$data_column = ClassRegistry::init($className)->getDisplayFieldName();
		$old_data = $value[$className][$data_column];
		
		
		if($this->_input!==$old_data && $old_data !=''){
			$logs[]= array(
				'log_dt'		=>date(AppModel::SQL_DTF),
				'contact_id'	=>$contact_id,				
				'description' 	=>"Changed <strong>$field_name</strong> from <i>$old_data</i> to <i>$this->_input</i>" ,
				'user_id'		=>$user_id 
			);
		}

		if($this->_input!=""){
            //$value[$className][$data_column] = $this->_input;
            if($this->validates()){
				//$this->updateAll(array($data_column =>'\''.$this->_input.'\''),$condition);
            }
		}
		
	 	if(!empty($logs)){
			ClassRegistry::init('Log')->saveAll($logs);
		}	
		
		//reset the value incase
		$this->_input = null;	
		$this->_field_id = null;
	}


  
}
?>
