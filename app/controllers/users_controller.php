<?php
class UsersController extends AppController {
    
    public $name ='Users';

    public function index(){}



    public function register(){
        #$this->layout = null;
        if($this->data){                
            //TODO can improve the code here to use 
            if($this->data['User']['password']===$this->Auth->password($this->data['User']['confirm_password'])){
                #if($this->User->validate()){
                    $this->User->create();
                    $this->User->set($this->data);
                    $this->User->save();
                    $this->Session->setFlash(__("A email has been sent to your email address",true));
                    $this->layout = 'default';
                    $this->render('/elements/success');
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


    
    
}
?>
