<?php

class TypeSelectOption extends AppModel {
	
	public $name = 'TypeSelectOption';
	
	public $useTable='type_select_options';
	
	public $_data_field = 'value';
	

	private function getField($params){
		return $this->find('all',array(
			'conditions' => array(
				'contact_type_id' => $params['contact_type_id'],
				'field_id'=>$params['field_id'] 
			) 
		));
		
	}
	
	public function displayOptions($params)
	{
		$field = $this->getField($params);
		return $this->formatter($field,$params);
	}
	
	public function display($params){
		$selects = $this->getField($params);
		$output = "<table class='adres-datagrid' >\n";
		$output .= $this->getShowTableHeader();
		
		foreach ($selects as $select){
			$output.="<tr>\n\t<td>";
			$output.=$select[$this->name][$this->_data_field];
			$output.="</td>\n<td>";
			$output.= $this->getLinks($select,$params);
			$output.="</td>\n\t</tr>";
		}
		return $output.="</table>\n";
	}
	
	public function formatter($selects,$params){
		extract($params);
		
		$field = ClassRegistry::init('Field')->read(null,$field_id);
		
		$label= '<div class="input text">
				<label for="'.$field['Field']['name'].'">'.$field['Field']['name'].'</label>';
		
        $output ='<select name="data['.$column_id.']['.$field_id.']">'."\n";

        $output .="<option value='0'>Select One</option >";
		foreach ($selects as $select) {
			$output.='<option value='.$select[$this->name]['id'].'>'.$select[$this->name][$this->_data_field].'</option>'."\n";
		}
		return $label.$output.='</select></div>';	
	}
	
	
	
	public function add($params){
		$field = $this->getField($params);
		return $this->getFormField($params);
	}
	
	public function process($form_data){
		//unset($form_data['_Token']);
		$this->save($form_data);
	}	
	
	public function edit($params){
		$option = $this->read(null,$params['id']);
		return $this->getFormField($params,array(
			'id'=>$params['id'],
			'data'=>$option[$this->name][$this->_data_field]
		));
	}
	
	
	public function delete($params){
		$this->del($params['id']);	
	}
	
	public function list_view(){
	
	}
	
	public function getLinks($select,$params){
		$output = "";
		$output.="<a class='adres-edit' href='/plugins/edit/id:{$select[$this->name]['id']}/field_id:{$params['field_id']}'>
		Edit</a>";
		$output.="<a class='adres-delete' href='/plugins/delete/id:{$select[$this->name]['id']}/field_id:{$params['field_id']}'>
		Delete</a>";
		return $output;
	}

	public function getShowTableHeader(){
		return "<tr><th>Data</th>\n<th>Operations</th></tr>\n";		
	}	
	
	public function getFormField($params,$options=array('data'=>null,'id'=>null)){
		extract($options);
		$output="";
		$output .= '<input type="hidden" name="data[field_id]" value="'.$params['field_id'].'">';

		if(!empty($data)){
			$value="value='{$data}'";
			$output.='<input type="hidden" name="data[id]" value="'.$id.'">';
		}else{
			$output.= '<input type="hidden" name="data[contact_type_id]" value="'.$params['contact_type_id'].'"]>';	
			$value='';
		}	
		$output .= '<input type="text" name="data['.$this->_data_field.']" '.$value.' >';
		return $output;
	}
}
?>
