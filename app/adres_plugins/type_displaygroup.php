<?php

//Jonathan Bigler - November 2011
//This type has for aim to display a column with the groups that the person is a part of.

App::import('Model','Plugin');
App::import('Model','Field');

class TypeDisplaygroup extends Plugin{



	var $useTable = false;
	
	public $optionsClass = 'TypeDisplaygroupOption';
    
    
    
	public function selectExt($data=array()){
		//Find the name of the field
		$fieldname = ClassRegistry::init('Field')->read('name',$data['field_id']);
		
		return ", GROUP_CONCAT(groups_".$data['field_id'].".name SEPARATOR ', ') AS '".$fieldname['Field']['name']."'";
	}

	public function joinExt($data=array()){
	
		//Find the parent group ID of the groups to be displayed
		$option = ClassRegistry::init($this->optionsClass);
		$parentgroup = $option->find('first',array('conditions' => "field_id = ".$data['field_id']));
		$parentgroup = $parentgroup['TypeDisplaygroupOption']['parentgroup'];
				
		//Find the list of the sub-groups' IDs (which should also be displayed)
		$subgroupsIds = ClassRegistry::init('Group')->getSubgroups($parentgroup);
		
		//Create a conditional expression so that only the desired subgroups will be displayed
		$condition = "groups_".$data['field_id'].".id = ".$parentgroup;
		foreach ($subgroupsIds as $subgroupId) {
			$condition = $condition." OR groups_".$data['field_id'].".id = ".$subgroupId ;
		}
		
		
		return " LEFT JOIN groups AS groups_".$data['field_id']." ON (ContactGroup.group_id = groups_".$data['field_id'].".id AND ( ".$condition." 	)) ";
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
