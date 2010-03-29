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
		//$this->Session->write('Filter.criteria',serialize(array('name'=>1,'condition'=>5)));
		
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
			$this->set(compact('contact','record','id'));
		}
		$this->set('status',true); 

    }


	public function show_record($id=null){
		$this->redirect_if_not_ajax_request();
		$this->redirect_if_id_is_empty($id);
		$contact_type = $this->Contact->read(array('Contact.contact_type_id'),$id);
		$plugins = $this->Field->getPluginTypes(
			$contact_type['Contact']['contact_type_id']);
		
		$contact= $this->Contact->getContact($id, array_values($plugins));
		$record = $this->Contact->generateRecord($contact,$plugins);		
		$this->set('status',true); 
		$this->set(compact('contact','record'));

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
		$types = $this->ContactType->getList($this->Session->read('Implementation.id'));
		$plugins = $this->Field->getPluginTypes($contact_type_id);
		$plugin_type = array_values($plugins);
		$contact_types = $this->ContactType->retriveAssociationsByContactType($plugin_type,$contact_type_id);
		$values = $this->ContactType->generateRecordSet($contact_types,$plugins);
        if(!$this->Session->check('Filter')){
            //TODO have to implement Session filters
        }
    	$this->set(compact('contact_types','plugins','values'));
		$this->render('/elements/contacts');
    }

	public function test(){
		if(!empty($this->data)){
			$contact_type_id = $this->data['Contact']['contact_type_id'];
			$plugins = $this->Field->getPluginTypes($contact_type_id);
			$this->Contact->data = $this->data;
			$this->Contact->update_record($plugins);
			$this->set(compact('plugins'));
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