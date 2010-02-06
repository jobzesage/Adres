<?php
class UsersController extends AppController {
    
    public $name ='Users';

    public function index(){}



    public function register(){
        $this->layout = null;
        if($this->data){                
            //TODO can improve the code here to use 
            if($this->data['User']['password']===Security::hash($this->data['User']['confirm_password'])){
                $this->User->create();
                $this->User->data = $this->data;
                $this->User->save();
            }else{
                $this->Session->setFlash('Password mis match');
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
