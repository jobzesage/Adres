<?php  



class TypeString extends AppModel {
	
	public $actsAs=array('Containable');
	
	public $useTable='type_string';
	
	public $primaryKey = false;
	

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

	public function renderEditForm($contact_id,$plugin)
	{
		$label ='<label>'.$plugin['Field']['name'].'</label>';
		$output  = '<input ';
		$output .= 'name['.$this->getJoinField().']['.$plugin['Field']['id'].']';
		$output .='/>';
		return  $label.$output;		
	}	
}
?>