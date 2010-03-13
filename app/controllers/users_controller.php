<?php
class UsersController extends AppController {
    
    public $name ='Users';
    
    public $uses=array('Contact','ContactType','Field','FieldType','Group','Implementation');
    	
    public function beforeFilter(){   
		parent::beforeFilter();
    }

    public function index(){
    	
    	$this->set('users',$this->paginate());
    }

    public function register(){
        #$this->layout = null;
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
	
		if(!$this->Session->check('Implementation')){
    		$implementation = ClassRegistry::init('Implementation')->find(
    			'first',array(
    				'fields'=>array('id','name')
    			));
			$this->Session->write('Implementation',$implementation['Implementation']);
    	}

		$plugins = $this->Field->getPluginTypes(5);

		$contact_types = $this->ContactType->find('all',array(
    		'contain'=>array(
    			'CurrentGroup',
    			'Field',
    			'Filter',
    			'Contact'=>$plugins
    		),
    		'conditions'=>array(
    			'ContactType.implementation_id'=>$this->Session->read('Implementation.id')
    		)
		));

        if(!$this->Session->check('Filter')){
            //TODO have to implement Session filters
        }
        
    	$this->set(compact('contact_types','plugins'));
    }
    	
	
	public function search(){
		if(!isset($_GET['keyword'])){
			$this->redirect(array('controller'=>'users', 'action' => 'home'));
		}
		$this->Session->write('Filter.keyword',$_GET['keyword']);
		//$this->Session->write('Filter.criteria',serialize(array('name'=>1,'condition'=>5)));
	}
	
	public function advance_search(){
		
	}
	
    public function add_record(){
        
    }


    public function delete_record() {

    }
    
    public function show_record($id=null){
    	if(!$id){
    		$this->redirect(array('controller'=>'users','action'=>'home'));
    	}
    	
    	$contact = $this->Contact->read(null,$id);
    	
    	$contactType = $contact['Contact']['contact_type_id'];
    	$plugins = $this->Field->getPluginTypes($contactType);
    	$contacts = $this->ContactType->find('all',array(
    		'contain'=>array(
    			'Contact',
    			'Field'
    		),
    		'conditions'=>array(
    			'ContactType.id'=>$contactType
    		)
		));
		
		$this->set(compact('contacts'));
    }
    
}
?>