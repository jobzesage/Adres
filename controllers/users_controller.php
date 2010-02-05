<?php
class UsersController extends AppController {
    
    public $name ='Users';



    public function beforeFilter(){}


    public function index(){}
    
    
    public function login(){
        $this->layout = null;
    }
    
    public function logout(){
        $this->redirect($this->Auth->logout());
    }
        
    
}
?>
