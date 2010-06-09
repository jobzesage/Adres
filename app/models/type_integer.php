<?php  

App::import('Model','Plugin');

class TypeInteger extends Plugin {
	
	public $actsAs=array('Containable');
	
	public $useTable='type_integer';
	
	//public $belongsTo=array(
	//	'Field'=>array(
	//		'foreignKey'=>$this->getJoinField()			
	//	)
	//);
	
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
	
	public function renderEditForm($contact_id,$plugin,$wrapper=array())
	{	
		$data = $this->find('first',array('conditions'=>array(
				'contact_id' 	=> $contact_id,
				'field_id'		=>$plugin['Field']['id'] 	
			)));
			
		$data = $data[$this->name][$this->getDisplayFieldName()];
		
		$label ='<label>'.$plugin['Field']['name'].'</label>';
		$output  = '<input ';
		$output .= 'name="data['.$this->getJoinField().']['.$plugin['Field']['id'].']"';
		$output .= ' value="'.$data.'"';
		$output .='/>';
		return  $label.$output;		
	}

}
?>