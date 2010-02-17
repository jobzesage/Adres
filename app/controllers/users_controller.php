<?php
class UsersController extends AppController {
    
    public $name ='Users';

    public function index(){
    	$this->set('users',$this->paginate('User'));
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

    }




    public function logout() {
        $this->redirect($this->Auth->logout());
    }
    
    
    
    public function home(){
    		
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
}
?>
