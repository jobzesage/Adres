<?php  


class TypeInteger extends AppModel {
	
	public $actsAs=array('Containable');
	
	public $useTable='type_integer';
	
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