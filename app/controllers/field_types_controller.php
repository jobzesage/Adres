<?php
class FieldTypesController extends AppController {

	public $name = 'FieldTypes';

	public function index() {
		$this->paginate=array('FieldType'=>array(
				'contain'=>array('Form','Field')
			));
		
		$this->set('fieldTypes', $this->paginate('FieldType'));
	}

	public function view($class_name = null) {
		if (!$class_name) {
			$this->Session->setFlash(__('Invalid FieldType', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('fieldType', $this->FieldType->findByClassName($class_name));
	}

	public function add() {
		if (!empty($this->data)) {
			$this->FieldType->create();
			if ($this->FieldType->save($this->data)) {
				$this->Session->setFlash(__('The FieldType has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The FieldType could not be saved. Please, try again.', true));
			}
		}
	}

	public function edit($class_name = null) {
		if (!$class_name && empty($this->data)) {
			$this->Session->setFlash(__('Invalid FieldType', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FieldType->save($this->data)) {
				$this->Session->setFlash(__('The FieldType has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The FieldType could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FieldType->findByClassName($class_name);
		}
	}

	public function delete($class_name = null) {
		if (!$class_name) {
			$this->Session->setFlash(__('Invalid id for FieldType', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->FieldType->del(array('class_name'=>$class_name))) {
			$this->Session->setFlash(__('FieldType deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The FieldType could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>