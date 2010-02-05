<?php
class UsersController extends AppController {
    
    public $name ='Users';

    public function index(){}

    public function register(){
        $this->layout = null;
    
    }

    public function login() {
        $this->layout = null;
        if(isset($this->data)){
            var_dump($this->data);    
        } 
    }

    public function logout() {
        
    }
    
    
    
}
?>
