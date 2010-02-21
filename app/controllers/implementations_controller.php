<?php
class ImplementationsController extends AppController {

	public $name = 'Implementations';


	public function index() {
		$this->set('implementations', $this->paginate());
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Implementation', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('implementation', $this->Implementation->read(null, $id));
	}

	public function add() {
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

	public function edit($id = null) {
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

	public function delete($id = null) {
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
