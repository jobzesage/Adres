<?php
class FiltersController extends AppController {

    public $name = 'Filters';

    public function index() {
        $this->paginate=array('Filter'=>array(
            'contain'=>array('ContactType')
        ));
        $this->set('filters', $this->paginate());
    }

    public function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid Filter', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('filter', $this->Filter->read(null, $id));
    }

    public function add() {
        if (!empty($this->data)) {
            $this->Filter->create();
            if ($this->Filter->save($this->data)) {
                $this->Session->setFlash(__('The Filter has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Filter could not be saved. Please, try again.', true));
            }
        }
    }

    public function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid Filter', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Filter->save($this->data)) {
                $this->Session->setFlash(__('The Filter has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Filter could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Filter->read(null, $id);
        }
    }

    public function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Filter', true));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Filter->del($id)) {
            $this->Session->setFlash(__('Filter deleted', true));
            if(!$this->RequestHandler->isAjax()){
                $this->redirect(array('action' => 'index'));
            }else{
                $this->layout = "users";
                $this->set('status',true);
            }
        }

    }

    public function collection($contact_type_id=null){
        $this->layout = 'api';
        $this->disableDebugger();
        $data['filters']=$this->Filter->getlist($contact_type_id);
        $this->set('data', $data);
        $this->render('/elements/json_data');
    }

    public function affiliations($affiliation_id=null){
        $this->layout = 'api';
        $this->disableDebugger();

        $Affiliation  = $this->Filter->ContactType->Contact->Affiliation;
        $affiliation   = $Affiliation->getAffiliationArray($affiliation_id);
        $affiliation  = $Affiliation->findById($affiliation['id']);
        $contactTypes = null;
        if( !empty($affiliation) ){
            $contactTypes = array(
                $affiliation['Affiliation']['contact_type_father_id'],
                $affiliation['Affiliation']['contact_type_child_id'],
            );
        }

        //change the code
        $current_contact_type = array($this->Session->read('Contact.contact_type_id'));

        $affiliated_contact_type = array_pop(array_diff($contactTypes, $current_contact_type));
        if(empty($affiliated_contact_type)){
            $affiliated_contact_type = $this->Session->read('Contact.contact_type_id');
        }

        $data['Filters'] = $this->Filter->getTemplatedList($affiliated_contact_type);
        $this->set('data', $data);
        $this->render('/elements/json_data');
    }

}
