<?php  
class TypeString extends AppModel {
	
	public $actsAs=array('Containable');
	
	public $useTable='type_string';
	
	public $primaryKey = false;
	
	private $_display_field_name = 'data';
	
	
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
		
	}
	
}
?>