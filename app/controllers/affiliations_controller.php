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
		if (!$id) {
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
			$this->data = $this->Affiliation->findById($id);
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


	public function delete_association($id=null){
		if($id){
			$this->Affiliation->query("delete from affiliations_contacts where id=$id");
			$this->set('status',true);
			$this->layout = 'default';
			$this->render('/elements/empty');
		}
    }



    public function collection($contact_type_id){
        $this->layout = 'api';
        $this->disableDebugger();
        $data['Affiliations'] = $this->Affiliation->getList($contact_type_id);
        $this->set('data', $data);
        $this->render('/elements/json_data');
    }


    public function relate()
    {
        $this->layout= 'default';
        if( $this->data){
            $affiliation= array();
            $affiliation['id']                 = substr($this->data['Affiliate']['affiliation_id'],1);
            $affiliation['type']               = substr($this->data['Affiliate']['affiliation_id'],0,1);
            $affiliation['current_contact_id'] = $this->data['Affiliate']['current_contact_id'];
            $affiliation['contact_id']         = $this->data['Affiliate']['contact_id'];
            $relationship                      = $this->Affiliation->getRelationship($affiliation);

            if($relationship){
                $this->Affiliation->FatherContactType->Contact->log_message ='Contact '.$this->data['Affiliate']['contact_id'] .' and '.$this->data['Affiliate']['current_contact_id']. ' are now affiliated';
                $this->Affiliation->FatherContactType->Contact->saveAfilliation($relationship);
            }
        }// used to affiliate

        $this->render(false);
    }

}
