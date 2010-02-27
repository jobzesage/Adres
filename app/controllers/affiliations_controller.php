<?php
class AffiliationsController extends AppController {

	public $name = 'Affiliations';

	public function index() {
		$this->paginate=array(
			'Affiliation'=>array(
				'contain'=>array(
					'FatherContactType',
					'ChildContactType'
		)));
		
		$this->set('affiliations', $this->paginate('Affiliation'));
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Affiliation', true));
			$this->redirect(array('action' => 'index'));
		}
		$affiliation=$this->Affiliation->find('first',array(
			'contain'=>array(
				'FatherContactType',
				'ChildContactType'
			),
			'conditions'=>array('Affiliation.id'=>$id)
		));
		$this->set(compact('affiliation'));
	}

	public function add() {
		if (!empty($this->data)) {
			$this->Affiliation->create();
			if ($this->Affiliation->save($this->data)) {
				$this->Session->setFlash(__('The Affiliation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Affiliation could not be saved. Please, try again.', true));
			}
		}
		$fatherContactTypes = $this->Affiliation->FatherContactType->find('list');
		$childContactTypes = $this->Affiliation->ChildContactType->find('list');
		$this->set(compact('fatherContactTypes', 'childContactTypes'));
	}

	public function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Affiliation', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Affiliation->save($this->data)) {
				$this->Session->setFlash(__('The Affiliation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Affiliation could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Affiliation->findById($id,array(
				'contain'=>array(
					'FatherContactType',
					'ChildContactType'
			)));
		}
		$fatherContactTypes = $this->Affiliation->FatherContactType->find('list');
		$childContactTypes = $this->Affiliation->ChildContactType->find('list');
		$this->set(compact('fatherContactTypes','childContactTypes'));
	}

	public function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Affiliation', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Affiliation->del($id)) {
			$this->Session->setFlash(__('Affiliation deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Affiliation could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>