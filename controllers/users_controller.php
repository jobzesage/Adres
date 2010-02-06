<?php
class UsersController extends AppController {
    
    public $name ='Users';

    public function index(){}



    public function register(){
        $this->layout = null;
        if($this->data){                
            //TODO can improve the code here to use 
            if($this->data['User']['password']===$this->Auth->password($this->data['User']['confirm_password'])){
                #if($this->User->validate()){
                    $this->User->create();
                    $this->User->set($this->data);
                    $this->User->save();
                #}
            }else{
                $this->Session->setFlash('Password mismatch');
            }

        }else{
            #$this->redirect('/login');
        }
    }



    public function login() {
        $this->layout = null;
        if(isset($this->data)){
            var_dump($this->data);    
        } 
    }




    public function logout() {
        $this->redirect($this->Auth->logout());
    }


    
    
    
    
}
?>
