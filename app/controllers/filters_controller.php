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
                	$this->set('status',true);
                }
            }

        }

}
