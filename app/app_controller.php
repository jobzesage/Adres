<?php

App::import('Security');
Security::setHash('SHA1');

abstract class AppController extends Controller {
    
    public $helpers =array('Html','Form','Session','Javascript','Time','Text');

    public $components = array(
    	'Auth',
    	'Session',
    	'Cookie',
    	'RequestHandler',
    	'Security',
    	'DebugKit.Toolbar'
    );
    
    public function beforeFilter() {
    	
    	//$this->autoLogoutMessage();
    	
        $this->Auth->fields = array(
            'username' => 'username',
            'password' => 'password'
        );
		$this->Auth->allow('register','login');
        
        $this->Auth->userScope = array('User.is_active' => 1);
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
                $this->setFlash('You have been logged out due to inactivity');
                //for error set the second parameter
            }else{
                $this->Session->write('logging_out_time',$this->Session->sessionTime);				
            }
        }
    }

    
    public function isAuthenticated() {
        return !!$this->Auth->user('id');
    }

	public function isAuthorized() {
		return true;
	}
    
    
    protected function setFlash($message,$layout='success') {
        $this->Session->setFlash($message);
    }
    
    
    public function beforeRender(){
			$this->set('implementations_list', $this->getImplementaions());
    }


	
    public function getImplementaions(){
    	return ClassRegistry::init('Implementation')->find('list',array('fields'=>array('id','name'),'contain'=>false));
    }
	
}
?>
