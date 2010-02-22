<?php
class FieldsController extends AppController {

	public $name = 'Fields';

	public function index() {
		$this->paginate=array('Field'=>array('contain'=>array('ContactType')));
		$this->set('fields', $this->paginate('Field'));
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Field', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('field', $this->Field->read(null, $id));
	}

	public function add() {
		
		$this->set('contact_types',$this->_setContactTypeList());
		
		$this->set('field_types',$this->_setFieldTypeList());
		
		if (!empty($this->data)) {
			$this->Field->create();
			if ($this->Field->save($this->data)) {
				$this->Session->setFlash(__('The Field has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Field could not be saved. Please, try again.', true));
			}
		}
	}

	public function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Field', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Field->save($this->data)) {
				$this->Session->setFlash(__('The Field has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Field could not be saved. Please, try again.', true));
			}
		}
		
		if (empty($this->data)) {
			$this->set('contact_types',$this->_setContactTypeList());
			$this->set('field_types',$this->_setFieldTypeList());			
			$this->data = $this->Field->read(null, $id);
		}
	}

	public function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Field', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Field->del($id)) {
			$this->Session->setFlash(__('Field deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Field could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
	
	protected function _setContactTypeList(){
		return	ClassRegistry::init('ContactType')->find('list');	
	}

	protected function _setFieldTypeList(){
		return	ClassRegistry::init('FieldType')->find('list',array('fields'=>array('class_name','nice_name')));	
	}
}
?>