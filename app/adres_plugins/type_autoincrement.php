<?php

//Jonathan Bigler - November 2011

App::import('Model','Plugin');

class TypeAutoincrement extends Plugin {



	public $useTable='type_auto_increments';
	
	public $belongsTo = array('Contact');

	public $_adresValidate=array(
        'notEmptyFields'=>array(
            'rule'=>'notEmpty',
            'message'=>'field can not be blank'
        )
    );
    
    




		
	public function processEditForm($options)
    {    
    
        //not a good idea to use extract :(
		extract($options);

		if(!empty($field_id)){
			$this->_field_id = $field_id;
		}

		
    	//Find the greatest used indice, and add 1. 
		$new_indice = $this->query("select MAX(data) from type_auto_increments WHERE field_id = ".$this->_field_id.";");
		$new_indice = $new_indice[0][0]['MAX(data)']+1;
		
		

		$condition =  array(
			'contact_id'	=>$contact_id,
			'field_id'		=>$this->_field_id
		);
		
		
		$value = $this->find('first',array(
			'conditions' =>$condition
		));

		$data_column = ClassRegistry::init($className)->getDisplayFieldName();
		$old_data = $value[$className][$data_column];

		$this->log("New indice = ".$new_indice." Old indice = ".$old_data);
		
		//If it's a new record, save the new indice.
		if($old_data ==''){
            $this->updateAll(array($data_column =>'\''.$new_indice.'\''),$condition);
		}


		//reset the value incase
		$this->_field_id = null;
	}
	
	
	
	public function renderEditForm($contact_id,$plugin,$wrapper=array('tag'=>'div')){
		
		//Do not give any fields to edit this value
		return "";
	}


}
?>
