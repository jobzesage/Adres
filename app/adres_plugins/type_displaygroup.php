<?php

//Jonathan Bigler - November 2011
//This type has for aim to display a column with the groups that the person is a part of.

App::import('Model','Plugin');

//class TypeDisplaygroup extends Plugin {

class TypeDisplaygroup extends Plugin{



	var $useTable = false;
	
//	public $belongsTo = array('Contact');
/*
	public $_adresValidate=array(
        'notEmptyFields'=>array(
            'rule'=>'notEmpty',
            'message'=>'field can not be blank'
        )
    );
  */  
    
    
    
	public function selectExt($data=array()){
		return ", GROUP_CONCAT(groups.name SEPARATOR ', ') AS 'Groups'";
	}

	public function joinExt($data=array()){
		return " LEFT JOIN groups ON (ContactGroup.group_id = groups.id ) ";
	}

	public function whereExt(){
		return "";
	}



		
	public function processEditForm()
    {    
		// No edit
	}
	
	
	
	public function renderEditForm(){
		// No edit
	}


}
?>
