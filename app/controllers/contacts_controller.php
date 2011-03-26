<?php
class ContactsController extends AppController {
	
	public $layout = 'default';

	public $name = 'Contacts';
	
	public $uses = array('Contact','User');

	public function index() {
		$this->paginate=array(
			'Contact'=>array(
				'contain'=>array(
					'ContactType',
					'Group'
					#'Field'
			)));
		
		$this->set('contacts', $this->paginate('Contact'));
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Contact', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('contact', $this->Contact->read(null, $id));
	}

	public function add() {
		if (!empty($this->data)) {
			$this->Contact->create();
			if ($this->Contact->save($this->data)) {
				$this->Session->setFlash(__('The Contact has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Contact could not be saved. Please, try again.', true));
			}
		}
	}

	public function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Contact', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Contact->save($this->data)) {
				$this->Session->setFlash(__('The Contact has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Contact could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Contact->read(null, $id);
		}
	}

	public function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Contact', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Contact->del($id)) {
			$this->Session->setFlash(__('Contact deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Contact could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
	

	
	public function export()
	{
		$this->helpers = array('Csv');
		$this->set('data',$this->User->find('all'));
	}
	
	public function restore($id=null)
	{
		$this->set('status',true);
		$contact = $this->Contact->read(null,$id);
		if(!empty($contact)){
			$contact['Contact']['trash_id']=0;
			$this->Contact->counter_cache($contact['Contact']['contact_type_id'],1); 
			#adds a record to counter cache for restoring a contact
			$this->Contact->save($contact);
		}
	}
}
?>