<?php
class UsersController extends AppController {
    
    public $name ='Users';
    
    public $uses=array('Contact','ContactSet','ContactType','Field','FieldType','Group','Implementation');
    	
    public function index(){
    	
    	$this->set('users',$this->paginate());
    }

    public function register(){
        #$this-<br>>layout = null;
        if($this->data){                
            //TODO can improve the code here to use 
            if($this->data['User']['password']===$this->Auth->password($this->data['User']['confirm_password'])){
                #if($this->User->validate()){
                    $this->User->create();
                    $this->User->save($this->data);
                    $this->Session->setFlash(__("A email has been sent to your email address",true));
                #}
            }else{
                $this->Session->setFlash(__('Password mismatch',true));
            }
        }else{
            #$this->redirect('/login');
        }
    }



    public function login() {
    	if($this->Auth->user()){
    		$this->redirect(array('controller'=>'users','action'=>'home'));
    	}
	
    }

    public function logout() {
    	$this->Session->destroy();
        $this->redirect($this->Auth->logout());
        
    }
    

	public function delete($id=null){
		if (!$id) {
			$this->flash(__('Invalid User', true), array('action' => 'index'));
		}
		if ($this->User->del($id)) {
			$this->flash(__('Group deleted', true), array('action' => 'index'));
		}
		$this->flash(__('The Group could not be deleted. Please, try again.', true), array('action' => 'index'));
		
		
	}


    public function home(){
		if(!$this->isAuthenticated()){
			$this->flash('Something wrong','/');
		}
	
		$this->setImplementation();
		
		if(!$this->Session->check('Filter')){
		    //TODO have to implement Session filters
		}
        $this->set('types',$this->ContactType->getAllByImplementationId($this->Session->read('Implementation.id')));
    }
    	
	
	public function search(){
		$this->redirect_if_not_ajax_request();
		
		if(!isset($_GET['keyword'])){
			$this->redirect(array('controller'=>'users', 'action' => 'home'));
		}
		$this->Session->write('Filter.keyword',$_GET['keyword']);
		$this->set('status',true);
		$this->render('/elements/contacts');
	}
	
	public function advance_search(){
		debug($this->data);
		die();
	}
	
    public function edit_record($id=null){
		$this->redirect_if_not_ajax_request();
		$this->redirect_if_id_is_empty($id);
		
		if(empty($this->data)) {
			$contact_type = $this->Contact->read(array('Contact.contact_type_id'),$id);
			$plugins = $this->Field->getPluginTypes(
				$contact_type['Contact']['contact_type_id']);
			
			$contact= $this->Contact->getContact($id,array_values($plugins));
			$record = $this->Contact->generateRecord($contact,$plugins);
			$contact_id = $id;		
			$this->set(compact('contact','record','id','contact_id'));
		}
		$this->set('status',true); 

    }


	public function show_record($id=null){
		$this->redirect_if_not_ajax_request();
		$this->redirect_if_id_is_empty($id);
		$contact_type = $this->Contact->read(array('Contact.contact_type_id'),$id);
		$plugins = $this->Field->getPluginTypes(
			$contact_type['Contact']['contact_type_id']);
		
		$contact = $this->Contact->getContact($id, array_values($plugins));
		$record = $this->Contact->generateRecord($contact,$plugins);		
		$this->set('status',true);
		$contact_id = $id ;
		$this->set(compact('contact','record','contact_id'));

    }
	
    public function delete_record($id=null){
		$this->redirect_if_not_ajax_request();
		$this->redirect_if_id_is_empty($id);
		$this->Contact->id = $id;
		$contact= $this->Contact->read('contact_type_id');
		$plugins = $this->Field->getPluginTypes($contact['Contact']['contact_type_id']);
		
		if($this->Contact->delete($id,$plugins)){
			$this->set('status',true);
		}
    }    
    

    public function display_contacts($contact_type_id=5){
    	$contact_type_id = !empty($_GET['contact_type_id'])? $_GET['contact_type_id'] : $contact_type_id;
		$types = $this->ContactType->getList($this->Session->read('Implementation.id'));
		//if(!$this->Session->check('Filter.contact_type_id'))
			$this->Session->write('Filter.contact_type_id',$contact_type_id);

    	
		$fields= $this->Field->getPluginTypes($contact_type_id);
		$keyword = "";
		if($this->Session->check('Filter.keyword')) $keyword = $this->Session->read('Filter.keyword');
		$values = $this->ContactSet->getContactSet($contact_type_id,$keyword);
		$this->set('values',$values);
		
		
    	$this->set(compact('fields','contact_type_id'));
    	$this->set(compact('contact_types','contact_type_id'));

		$this->render('/elements/contacts');
    }

	public function test(){
		if(!empty($this->data)){
			$this->Contact->user_id = $this->Auth->User('id');
			$contact_type_id = $this->data['Contact']['contact_type_id'];
			$plugins = $this->Field->getPluginTypes($contact_type_id);
			$contact = $this->data;
			$this->Contact->update_record($contact, $plugins);
			$this->set(compact('plugins'));
		}
	}


	public function add_record(){
		if(!empty($this->data)){
			$plugins = $this->Field->getPluginTypes($this->data['Contact']['contactTypeId']);
			$contact = $this->data;
			$this->Contact->user_id = $this->Auth->User('id');
			$this->Contact->save_record($contact,$plugins);
		}else {
			$contactTypeId = $this->params['named']['contact_type'];
			$plugins = $this->Field->getFieldTypes($contactTypeId);		
			$this->set(compact('contactTypeId','plugins'));
			//todo change this implementation		
		}
		$this->set('status',true);
	}



	public function show_details($contact_id){
		$contact = $this->Contact->getContact($contact_id);
		$groups = $this->Group->getList($contact);
		$this->set(compact('contact','groups','contact_id'));
		$this->set('status',true);
	}
	

	public function edit_details($contact_id){
		$this->set('status',true);
	}
	
	
	public function add_keyword($keyword=null){
		$this->set('status',true);
		$this->Session->write('Filter.keyword',$this->params['url']['keyword']);
		$this->display_contacts(5);
	}
	
	private function add_criteria($criteria){
		//TODO serialize criteria then save;
		$criteria = Set::filter($criteria);
		if($this->Session->check('Filter.criteria') && !empty($criteria)){
			$criterias = unserialize($this->Session->read('Filter.criteria'));
			foreach ($criteria as $field_id => $value) {
				$criterias[$field_id] = $value;
			}
		}else{
			$criterias  =$criteria;
		}
		$this->Session->write('Filter.criteria',serialize($criterias));
	}
	
	public function delete_keyword($keyword=null){
		$this->set('status',true);
		$this->Session->write('Filter.keyword',null);
		$this->display_contacts(5);
	}
	
	public function delete_criteria(){
		if($this->Session->check('Filter.criteria')){
			$criterias = unserialize( $this->Session->read('Filter.criteria'));
			$params= $this->params['named'];
			
			if(!empty($params) and in_array($params['criteria'],$criterias)){
				unset($criterias[(int)$params['id']]);
			}
			
			if(!empty($criterias)){
				$this->Session->write('Filter.criteria',serialize($criterias));
			}else {
				$this->Session->del('Filter.criteria');
			}
			
		}		
		$this->redirect(array('controller'=>'users','action'=>'home'));
	
	}		
	
	public function load_filter($id=null){
		//$this->redirect_if_not_ajax_request();
		$filter = ClassRegistry::init('Filter')->read(null,$id);
		if(!empty($filter)){
			$this->Session->write($filter);
		}
		$this->set('status',true);
		$this->redirect(array('action'=>'home'));
	}
	
	public function save_filter()
	{
		if ($this->Session->check('Filter') AND !empty($this->data)) {
			$this->set('status',true);
			ClassRegistry::init('Filter')->save(
				array(
					'name'=>$this->data['Filter']['name'],
					'keyword'=>$this->Session->read('Filter.keyword'),
					'criteria'=>'',
					'contact_type_id' =>$this->Session->read('Filter.contact_type_id')
			));
		}
	}
	
	
    //private functions
    private function setImplementation(){
    	if(!$this->Session->check('Implementation')){
    		$implementation = ClassRegistry::init('Implementation')->find(
    			'first',array(
    				'fields'=>array('id','name')
    			));
			$this->Session->write('Implementation',$implementation['Implementation']);
    	}
    }    
}
?>