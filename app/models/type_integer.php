<?php  


class TypeInteger extends AppModel {
	
	public $actsAs=array('Containable');
	
	public $useTable='type_integer';
	
	
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
		return $this->_join_field_name;
	}
}
?>