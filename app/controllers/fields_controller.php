<?php
class FieldsController extends AppController {

	var $name = 'Fields';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Field->recursive = 0;
		$this->set('fields', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Field', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('field', $this->Field->read(null, $id));
	}

	function add() {
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

	function edit($id = null) {
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
			$this->data = $this->Field->read(null, $id);
		}
	}

	function delete($id = null) {
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

}
?>