<?php
class ContactTypesController extends AppController {

	public $name = 'ContactTypes';

	public function index() {
		
		$this->paginate=array(
			'ContactType'=>array(
				'contain'=>array(
					'Implementation'
				)));
				
		$this->set('contactTypes', $this->paginate('ContactType'));
	}

	public function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid ContactType', true), array('action' => 'index'));
		}
		$this->set('contactType', $this->ContactType->read(null, $id));
	}

	public function add() {
		$this->_setImplementationList();
		if (!empty($this->data)) {
			$this->ContactType->create();
			if ($this->ContactType->save($this->data)) {
				$this->flash(__('ContactType saved.', true), array('action' => 'index'));
			} else {
			}
		}
	}

	public function edit($id = null) {
		
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid ContactType', true), array('action' => 'index'));
		}
		
		$this->_setImplementationList();
		
		if (!empty($this->data)) {
			if ($this->ContactType->save($this->data)) {
				$this->flash(__('The ContactType has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ContactType->read(null, $id);
		}
	}

	public function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid ContactType', true), array('action' => 'index'));
		}
		if ($this->ContactType->del($id)) {
			$this->flash(__('ContactType deleted', true), array('action' => 'index'));
		}
		$this->flash(__('The ContactType could not be deleted. Please, try again.', true), array('action' => 'index'));
	}
	
	#for applicaiont use only
	private function _setImplementationList(){
		$this->set('implementations',ClassRegistry::init('Implementation')->find('list'));
	}	

}
?>