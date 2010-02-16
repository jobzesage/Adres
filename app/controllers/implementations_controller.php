<?php
class ImplementationsController extends AppController {

	var $name = 'Implementations';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->set('implementations', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Implementation', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('implementation', $this->Implementation->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Implementation->create();
			if ($this->Implementation->save($this->data)) {
				$this->Session->setFlash(__('The Implementation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Implementation could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Implementation', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Implementation->save($this->data)) {
				$this->Session->setFlash(__('The Implementation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Implementation could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Implementation->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Implementation', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Implementation->del($id)) {
			$this->Session->setFlash(__('Implementation deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Implementation could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>
