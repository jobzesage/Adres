<?php  

/**
* 
*/
class ContactSet extends AppModel
{
	public $useTable =false;

	public $belongsTo = array(
		'TypeString',
		'TypeInteger'
	);
	
	public function build_query($contactType,$plugins)
	{

		$select = 'SELECT DISTINCT (Contact.id) AS id ';
		
		$from = ' FROM contacts AS Contact '; 
		
		$where =' WHERE Contact.contact_type_id = '.$contactType;
		
		$keyword = "";
		
		//Custom fields
		foreach($plugins as $field){
			
			$pluginName = $field['Field']['field_type_class_name'];
			
			$plugin = $this->$pluginName;
			
			$select .= ' , '.$pluginName.'_'.$field['Field']['id'].'.'. $plugin->getDisplayFieldName() ;
			$select .= '  AS "'.$field['Field']['name'].'"';
			
			$from.= ' LEFT JOIN '.$plugin->useTable .' AS ';
			$from.= $plugin->name.'_'.$field['Field']['id'];
			$from.= ' ON (Contact.id ='.$plugin->name.'_'.$field['Field']['id'].'.contact_id';#change it to a func
			$from.= ' AND '.$plugin->name.'_'.$field['Field']['id'].'.field_id = '.$field['Field']['id'] .' )';#change it to a func
			
		}
		
		$sql = $select.$from.$where;
		return $sql;
	
	}	
		
}


?>