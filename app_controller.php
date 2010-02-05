<?php

App::import('Security');

Security::setHash('sha1');

abstract class AppController extends Controller {
    
    public $helpers =array('Html','Form','Session','Javascript','Time','Text');

    public $components = array('Auth','Session','Cookie','RequestHandler','Security');
    
    
    public function beforeFilter() {
        
       $this->Auth->fields = array(
            'username' => 'username',
            'password' => 'password'
        );
        $this->Auth->allow('*');
        $this->Auth->userScope = array('User.active' => 1);
        $this->Auth->authorize = 'controller';
        $this->Auth->authenticate = $this;
        $this->Auth->autoRedirect = true;
        $this->Auth->userModel = 'User';
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'home');

        parent::beforeFilter();
        
        $this->Security->blackHoleCallback = 'blackHole';
    }

    



    public function autoLogoutMessage(){
    
        if(!$this->Session->check('logging_out_time') and $this->Session->valid()){
            $this->Session->write('logging_out_time',$this->Session->sessionTime);
        }else{
            if($this->Session->time > $this->Session->read('logging_out_time')){
                $this->setFlash('You have been logged out due to inactivity');//for error set the second parameter
            }else{
                $this->Session->write('logging_out_time',$this->Session->sessionTime);				
            }
        }
    }

    
    public function isAuthenticated() {
        return !!$this->Auth->user('id');
    }

    
    
    public function beforeRender(){
        if($this->isAuthenticated()){
            //TODO apply some redirection logic
        } 
    }


    final public function hashPasswords($data) {
        $userModel = $this->Auth->userModel;
        $fields = $this->Auth->fields;
        if (is_array($data) && isset($data[$userModel])) {
            if (isset($data[$userModel][$fields['username']]) && isset($data[$userModel][$fields['password']])) {
                $data[$userModel][$fields['password']] = Security::hash($data[$userModel][$fields['password']], null ,false);
            }
        }
        return $data;
    }

}
?>
