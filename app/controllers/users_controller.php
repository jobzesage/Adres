<?php
class UsersController extends AppController {
    
    public $name ='Users';
    
    public $uses=array('Contact','ContactType','Field','FieldType','Group','Implementation');
    	
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
    

    public function display_contacts($contact_type_id=null){
		$contact_type_id = !empty($_GET['contact_type_id'])? $_GET['contact_type_id'] : $contact_type_id;

		$types = $this->ContactType->getList($this->Session->read('Implementation.id'));
		$plugins = $this->Field->getPluginTypes($contact_type_id);
		$plugin_type = array_values($plugins);

    	if($this->RequestHandler->isAjax() AND !empty($_GET['keyword'])){
    		$this->set('status',true);
			$keyword = $_GET['keyword'];
			$this->Session->write('Filter.keyword',$keyword);
			$contact_types = $this->ContactType->retriveAssociationsByContactType($plugin_type,$contact_type_id,$keyword);
    	}else{
			$contact_types = $this->ContactType->retriveAssociationsByContactType($plugin_type,$contact_type_id);
    	}
    	
		$values = $this->ContactType->generateRecordSet($contact_types,$plugins);

        if(!$this->Session->check('Filter')){
            //TODO have to implement Session filters
        }
    	$this->set(compact('contact_types','plugins','values','contact_type_id'));
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