<?php

class PluginsController extends AppController {

	public $name = 'Plugins';

	public function index() {

	}

	public function show() {
		$params = am($this->params['named'],array('column_id'=>'data'));
		$className = $this->getOptionClassName($params['field_id']);
		$this->set('output',ClassRegistry::init($className)->display($params));		
	}
	
	public function add(){
		if (!$this->data) {
			$params = am($this->params['named'],array('column_id'=>'data'));
			$optionsName = $this->getOptionClassName($params['field_id']);
			$this->set('input_field',ClassRegistry::init($optionsName)->add($params));
			
		}else{
			$optionsName = $this->getOptionClassName($this->data['field_id']);
			ClassRegistry::init($optionsName)->process($this->data);
			$this->redirect(array(
				'controller' => 'plugins', 
				'action' => 'show', 
				'contact_type_id'=>$this->data['contact_type_id'],
				'field_id' => $this->data['field_id'] 
			));
		}
	}

	public function edit(){
		if (!$this->data) {
			$params = am($this->params['named'],array('column_id'=>'data'));
			$optionsName = $this->getOptionClassName($params['field_id']);
			$this->set('input_field',ClassRegistry::init($optionsName)->edit($params));
		}else{
			$optionsName = $this->getOptionClassName($this->data['field_id']);
			ClassRegistry::init($optionsName)->process($this->data);
			$optionData = ClassRegistry::init($optionsName)->read(null,$this->data['id']);
			
			$this->redirect(array(
				'controller' => 'plugins', 
				'action' => 'show', 
				'contact_type_id'=>$optionData[$optionsName]['contact_type_id'],
				'field_id' => $this->data['field_id'] 
			));
		}
		
	}

	public function delete(){
		$params = am($this->params['named'],array('column_id'=>'data'));
		$optionsName = $this->getOptionClassName($params['field_id']);
		$optionData = ClassRegistry::init($optionsName)->read(null,$params['id']);
		ClassRegistry::init($optionsName)->delete($params);
		$this->redirect(array(
			'controller' => 'plugins', 
			'action' => 'show', 
			'contact_type_id'=>$optionData[$optionsName]['contact_type_id'],
			'field_id' => $optionData[$optionsName]['field_id']
		));

	}
	
	private function getOptionClassName($field_id){
		$className = $this->getFieldClassType($field_id);
		return ClassRegistry::init($className)->optionsClass;
	}
}
?>