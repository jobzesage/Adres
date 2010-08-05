<?php
App::import('Sanatize');

class Plugin extends AppModel {
	
	public $useTable = false;
	
	public $primaryKey = false;
	
	protected $_display_field_name = 'data';
	
	protected $_join_contact_name = 'contact_id';

	protected $_join_field_name = 'field_id';	
	
	public $_input = null;

	public $_field_id = null;
	

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
	

	

	public function processAdvancedSearch($field_id,$column_name, $value)
	{
		$query_string['sql'] =$this->name.'_'.$field_id .'.'.$this->getJoinContact().' IN (SELECT '.$this->getJoinContact().' FROM '.$this->useTable .' as t WHERE t.'.$this->getDisplayFieldName().' LIKE "%'.$value.'%" AND t.field_id = '.(int) $field_id. ' )';
		$query_string['name'] = $column_name." like ".$value;
		
		return $query_string;
	}
	
	public function renderShowDetail($field_name,$value,$wrapper=array('tag'=>'td')){
		//TODO wrapper will be used to wrap this column
		$data_column = $this->getDisplayFieldName();
		$output ="";
		if($value){
			$output.= '<th>';
			$output.= $field_name;
			$output.= " : ";
			$output.= '</th>';		
			
			$output.= '<'.$wrapper['tag'].'>';
			$output.= $value[$this->name][$data_column];
			$output.= '</'.$wrapper['tag'].'>';
		}
		return '<tr>'.$output.'</tr>';
	}


	
	
	public function renderEditForm($contact_id,$plugin,$wrapper=array('tag'=>'div')){	
		
		$data = $this->find('first',array('conditions'=>array(
				'contact_id' 	=> $contact_id,
				'field_id'		=>$plugin['Field']['id'] 	
			)));
			
		$data 	= $data[$this->name][$this->getDisplayFieldName()];
		
		$label 	= '<'.$wrapper['tag'].' class="input text">';
		$label .='<label for="'.$plugin['Field']['name'].'">'.$plugin['Field']['name'];
		
		$label .= (int)$plugin['Field']['required'] ? " * " : "" ;
		$label .= '</label>';
		
		$output  = '<input ';
		
		$output .= (int)$plugin['Field']['required'] ? " class ='required text ui-corner-all' " : " class='text ui-corner-all'" ; # for jquery validtion
		$output .= 'name="data['.$this->getJoinField().']['.$plugin['Field']['id'].']"';
		$output .= ' value="'.$data.'"';
		$output .='/>';
		$output .='</'.$wrapper['tag'].'>';

		return $label.$output;		
	}
	
	public function advanceSearchFormField($field,$options=array()){
		
		$defaults = array('tag'=>'div','class'=>'text input');
		$wrapper = am($defaults,$options);
		
		$label = "<{$wrapper['tag']} class='{$wrapper['class']}'>";
		$label .= '<label for="'.$field['Field']['name'].'" >'.$field['Field']['name'].'</label>';
		$input_style =' class="text span-5 ui-corner-all" ';
		$input_field = '<input '.$input_style.' name="data[AdvanceSearch]['.$field['Field']['id'].']" value="">';  
		$input_field.="</{$wrapper['tag']}>"; 
		
		return $label.$input_field;
	}
	
	
	
	public function processEditForm($options)
	{
		extract($options);
		
		if(!empty($field_id)){
			$this->_field_id = $field_id;
		}
		
		//iterate through dataaset
		if(!isset($this->_input)){
			$this->_setInputData($form);
		}
		
		$condition =  array(
			'contact_id'	=>$contact_id,
			'field_id'		=>$this->_field_id	
		);					
		$value = $this->find('first',array(
			'conditions' =>$condition	
		));
		
		$data_column = ClassRegistry::init($className)->getDisplayFieldName();
		$old_data = $value[$className][$data_column];
		
		
		if($this->_input!==$old_data && $old_data !=''){
			$logs[]= array(
				'log_dt'		=>date(AppModel::SQL_DTF),
				'contact_id'	=>$contact_id,				
				'description' 	=>"Changed <strong>$field_name</strong> from <i>$old_data</i> to <i>$this->_input</i>" ,
				'user_id'		=>$user_id 
			);
		}

		if($this->_input!=""){
			//$value[$className][$data_column] = $this->_input;
			$this->updateAll(array($data_column =>'\''.$this->_input.'\''),$condition);
		}
		
	 	if(!empty($logs)){
			ClassRegistry::init('Log')->saveAll($logs);
		}	
		
		//reset the value incase
		$this->_input = null;	
		$this->_field_id = null;
	}
	
	
	private function _setInputData($form){
		if(isset($form['field_id'])){
			foreach($form['field_id'] as $fid=>$val){
				if ($this->_field_id == $fid) {
					$this->_input = $val; // apply Sanitization here
				}
			}
		}
	}
	
}
?>