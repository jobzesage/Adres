<?php

class AppModel extends Model {
	
	/**
	 * contact save text for description field
	 */
	const CONTACT_SAVE = "Created";
	
	
	/**
	 * sql date format 
	 */
	const SQL_DTF = 'Y-m-d H:i:s';
	
	public $recursive = -1;
	
	public $useDbConfig='development';

	/**
	 * Removes All associations
	 *
	 * @return void
	 * @author CraZyLegs
	 */
    public function unbindModelAll() {
        foreach(array(
                'hasOne' => array_keys($this->hasOne),
                'hasMany' => array_keys($this->hasMany),
                'belongsTo' => array_keys($this->belongsTo),
                'hasAndBelongsToMany' => array_keys($this->hasAndBelongsToMany)
        ) as $relation => $model) {
                $this->unbindModel(array($relation => $model));
        }
	} 
	
	public $_display_field_name = 'data';
	
	public $_join_contact_name = 'contact_id';

	public $_join_field_name = 'field_id';	
	
	
	public function getDisplayFieldName()
	{
		return $this->_display_field_name;
	}
	
	
	
	public function setDisplayFieldName($name)
	{
		$this->_display_field_name = $name;
	}
	

	public function renderAdvancedSearch($field_id,$column_name, $value)
	{
		$query_string['sql'] =$this->name.'_'.$field_id .'.'.$this->getJoinContact().' IN (SELECT '.$this->getJoinContact().' FROM '.$this->useTable .' as t WHERE t.'.$this->getDisplayFieldName().' LIKE "%'.$value.'%" AND t.field_id = '.(int) $field_id. ' )';
		$query_string['name'] = $column_name." like ".$value;
		return $query_string;
	}
	
	public function renderShowDetail(){
		//$value = $this->getDisplayFieldName();
		//if($value){
		//	echo "<p>";
		//	echo $this->field->getAttribute('fld_name');
		//	echo " : ";
		//	echo $value;
		//	echo "</p>";
		//}
	}		
}
?>
