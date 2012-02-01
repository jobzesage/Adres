<?php

//Jonathan Bigler - November 2011
//This type has for aim to display a column with the affiliation that the person has.

App::import('Model','Plugin');
App::import('Model','Field');

class TypeDisplayaffiliation extends Plugin{



	var $useTable = false;
	
	public $optionsClass = 'TypeDisplayaffiliationOption';
	
	var $hasOne = "TypeDisplayaffiliationOption";
	
    
    
    
	public function selectExt($data=array()){
		
		//Find the descriptive fields of the affiliated contact type
		$fields = $this->getDescriptiveFields($data);
		
		$affiliationId = $this->getAffiliationId($data);
		
		//Get the label of the field
		$fieldname = ClassRegistry::init('Field')->read('name',$data['field_id']);
		
		$sqlSelect = ", GROUP_CONCAT(DISTINCT CONCAT_WS(' '";
		
		foreach($fields as $field){
			$plugin = ClassRegistry::init($field['Field']['field_type_class_name']);
			$sqlSelect .= ", affiliateField_".$affiliationId."_".$field['Field']['id'].".".$plugin->getDisplayFieldName();
		}
		$sqlSelect .= ") SEPARATOR ', ') AS '".$fieldname['Field']['name']."'";
		
		return $sqlSelect;
	}
	
	
	

	public function joinExt($data=array()){
	
		$affiliationId = $this->getAffiliationId($data);
	
		//An affiliation can be see from two direction, from father to son, or from son to father.
		//This variable defines if we're looking at the relation from the father direction.
		//In a father affiliation, the current record is the father and we want to display the child in the column.
		$fatherAffiliation = $this->isAffiliationFather($data);
		
		if($fatherAffiliation) { //The current contact is on the father side of the affiliation
		
			$sqlJoin = " LEFT JOIN affiliations_contacts AS affiliationFather_".$data['field_id'];
			$sqlJoin .= " ON(affiliationFather_".$data['field_id'].".contact_father_id = Contact.id AND affiliationFather_".$data['field_id'].".affiliation_id = ".$affiliationId.") ";
			$sqlJoin .= " LEFT JOIN contacts AS contactChild_".$data['field_id']." ON(affiliationFather_".$data['field_id'].".contact_child_id = contactChild_".$data['field_id'].".id) ";
			
			
			//Find the descriptive fields of the affiliated contact type
			$fields = $this->getDescriptiveFields($data);
	
			
			//Generate the SQL statement to link to those fields
			foreach($fields as $field){
				$plugin = ClassRegistry::init($field['Field']['field_type_class_name']);
				$sqlJoin .= " LEFT JOIN ".$plugin->useTable;
				$sqlJoin .= " AS affiliateField_".$affiliationId."_".$field['Field']['id'];
				$sqlJoin .= " ON(contactChild_".$data['field_id'].".id = affiliateField_".$affiliationId."_".$field['Field']['id'].".".$plugin->getJoinContact();
				$sqlJoin .= " AND affiliateField_".$affiliationId."_".$field['Field']['id'].".".$plugin->getJoinField()." = ".$field['Field']['id']." ) "; 
			}
		}
		else{ //The current contact is on the child side of the affiliation
				
			$sqlJoin = " LEFT JOIN affiliations_contacts AS affiliationChild_".$data['field_id'];
			$sqlJoin .= " ON(affiliationChild_".$data['field_id'].".contact_child_id = Contact.id AND affiliationChild_".$data['field_id'].".affiliation_id = ".$affiliationId.") ";
			$sqlJoin .= " LEFT JOIN contacts AS contactFather_".$data['field_id']." ON(affiliationChild_".$data['field_id'].".contact_father_id = contactFather_".$data['field_id'].".id) ";
			
			
			//Find the descriptive fields of the affiliated contact type
			$fields = $this->getDescriptiveFields($data);
	
			
			//Generate the SQL statement to link to those fields
			foreach($fields as $field){
				$plugin = ClassRegistry::init($field['Field']['field_type_class_name']);
				$sqlJoin .= " LEFT JOIN ".$plugin->useTable;
				$sqlJoin .= " AS affiliateField_".$affiliationId."_".$field['Field']['id'];
				$sqlJoin .= " ON(contactFather_".$data['field_id'].".id = affiliateField_".$affiliationId."_".$field['Field']['id'].".".$plugin->getJoinContact();
				$sqlJoin .= " AND affiliateField_".$affiliationId."_".$field['Field']['id'].".".$plugin->getJoinField()." = ".$field['Field']['id']." ) "; 
			}
		}

		return $sqlJoin;
	}
	
	
	//Find the descriptive fields of the affiliated contact type
	//----------------------------------------------------------
	private function getDescriptiveFields($data=array()){
	
		
		
		//An affiliation can be see from two direction, from father to son, or from son to father.
		//This variable defines if we're looking at the relation from the father direction.
		//In a father affiliation, the current record is the father and we want to display the child in the column.
		$fatherAffiliation = $this->isAffiliationFather($data);
		
		
		//Get the affiliation
		$affiliation = ClassRegistry::init('Affiliation')->read(null, array($this->getAffiliationId($data)));
		
		//Find the descriptive fields related to this affiliation
		$condition = "is_descriptive AND contact_type_id = ";
		if($fatherAffiliation) //Determines whether we take the contact type of the father or the son
			$condition = $condition.$affiliation['Affiliation']['contact_type_child_id'];
		else
			$condition = $condition.$affiliation['Affiliation']['contact_type_father_id'];
		$fields = ClassRegistry::init('Field')->find('all',array('conditions' => $condition, 'order' => 'order'));
		
		return $fields; 
	
	}
	
	public function getAffiliationId($data=array()){
	
    	$option = ClassRegistry::init($this->optionsClass);
		return $option->getAffiliationId($data['field_id']);
	}
	
	public function isAffiliationFather($data=array()){
	
    	$option = ClassRegistry::init($this->optionsClass);
		return $option->isFatherAffiliation($data['field_id']);
	}
	

	public function whereExt($data=array()){
	}



	
	public function renderEditForm(){
		// No edit
	}
		
	public function processEditForm()
    {    
		// No edit
	}
	
	
	public function renderShowDetail(){
		// No detailed view
	}

	public function advanceSearchFormField(){
		// No advanced search
	}

}
?>
