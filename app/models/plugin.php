<?php  

class Plugin extends AppModel {
	
	public $useTable = false;
	
	public $primaryKey = false;
	
	protected $_display_field_name = 'data';
	
	protected $_join_contact_name = 'contact_id';

	protected $_join_field_name = 'field_id';		




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
	

	

	public function renderAdvancedSearch($field_id,$column_name, $value)
	{
		$query_string['sql'] =$this->name.'_'.$field_id .'.'.$this->getJoinContact().' IN (SELECT '.$this->getJoinContact().' FROM '.$this->useTable .' as t WHERE t.'.$this->getDisplayFieldName().' LIKE "%'.$value.'%" AND t.field_id = '.(int) $field_id. ' )';
		$query_string['name'] = $column_name." like ".$value;
		
		return $query_string;
	}
	
	public function renderShowDetail($field_name,$value,$wrapper=array()){
		//TODO wrapper will be used to wrap this column
		$data_column = $this->getDisplayFieldName();
		$output ="";
		if($value){
			$output.= "<p>";
			$output.= $field_name;
			$output.= " : ";
			$output.= $value[$this->name][$data_column];
			$output.= "</p>";
		}
		return $output;
	}
	
	
	
	public function processEditForm($data,$fields,$user_id=null)
	{
		$valid = true;
		$contact_id = $data['contact_id'];
		unset($data['contact_id']);
		unset($data['_Token']);
		$logs=array();


		foreach ($fields as $field) {
			$field_name = $field['Field']['name'];
			$className = $field['Field']['field_type_class_name'];
			
			foreach ($data['field_id'] as $field_id => $input){
				if($field['Field']['id']==$field_id){
					
					$condition =  array(
						'contact_id'	=>$contact_id,
						'field_id'		=>$field_id	
					);					
					$value = ClassRegistry::init($className)->find('first',array(
						'conditions' =>$condition	
					));
					
					$data_column = ClassRegistry::init($className)->getDisplayFieldName();
					$old_data = $value[$className][$data_column];
					if($input!==$old_data && $old_data !="")
					{
						$logs[]= array(
							'log_dt'		=>date(AppModel::SQL_DTF),
							'contact_id'	=>$contact_id,				
							'description' 	=>"Changed <strong>$field_name</strong> from <i>$old_data</i> to <i>$input</i>" ,
							'user_id'		=>$user_id 
						);
					}
					if($input!=""){
						$value[$className][$data_column] = $input;
						ClassRegistry::init($className)->updateAll(array($data_column =>'\''.$input.'\''),$condition);
					}
				}
			}//data foreach			
		}//plugin foreach
		
		if(!empty($logs)){
			ClassRegistry::init('Log')->saveAll($logs);
		}
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