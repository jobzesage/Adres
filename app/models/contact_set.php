<?php  

/**
* 
*/
class ContactSet extends AppModel
{
	public $useTable =false;

	
	public function getContactSet($contact_type_id,$searchKeyword=null,$filters=null)
	{
		$sql = $this->build_query($contact_type_id,$searchKeyword,$filters);
		return $this->query($sql);
	}


	private function build_query($contact_type_id,$searchKeyword,$filters)
	{

		$select = 'SELECT DISTINCT (Contact.id) AS id ';
		
		$from = ' FROM contacts AS Contact '; 
		
		$where =' WHERE Contact.contact_type_id = '.$contact_type_id .' ';
		
		$keyword = "";
		
		$plugins = ClassRegistry::init('Field')->getPluginTypes($contact_type_id);
		
		
		if(empty($plugins)){
			return "SELECT (Contact.id) AS id  FROM contacts as Contact
			LEFT JOIN contacts_groups as ContactGroup 
			ON (Contact.id = ContactGroup.contact_id )
			WHERE Contact.contact_type_id = ".$contact_type_id ." ".$filters;		
		}
			

		
		$models =array();
		foreach ($plugins as $field) {
			$models[]=$field['Field']['field_type_class_name'];
		}

		$this->bindModel(array('belongsTo'=>$models));
		
		//Custom fields
		$i=0;
		foreach($plugins as $field){
			
			$pluginName = $field['Field']['field_type_class_name'];
			
			$plugin = $this->$pluginName;
			
			$select .= ' , '.$pluginName.'_'.$field['Field']['id'].'.'. $plugin->getDisplayFieldName() ;
			$select .= '  AS "'.$field['Field']['name'].'"';
			
			$from.= ' LEFT JOIN '.$plugin->useTable .' AS ';
			$from.= $plugin->name.'_'.$field['Field']['id'];
			$from.= ' ON (Contact.id ='.$plugin->name.'_'.$field['Field']['id'].'.contact_id';#change it to a func
			$from.= ' AND '.$plugin->name.'_'.$field['Field']['id'].'.field_id = '.$field['Field']['id'] .' )';#change it to a func
			
			if($searchKeyword!=null){
				#change it to session key word
				if($i != 0)	$keyword = $keyword." OR ";
				$keyword = $keyword.$pluginName.'_'.$field['Field']['id'].'.'.$plugin->getDisplayFieldName();
				//$pluginName.'_'.$field['Field']['id'].'.'. $plugin->getDisplayFieldName();
				$keyword = $keyword." LIKE \"%".$searchKeyword."%\" ";
			}
			
			$i++;
		}
		

		
		//Filtering
		$where = $where.$filters;

		if($keyword != "")
		 $where = $where." AND ( ".$keyword." ) ";
		
		//Build the SQL query that can display the contacts
		$sql = $select.$from.$where;
		
		//echo $sql;
		return $sql;
	
	}	
		
}


?>