<?php

App::import('Security');
Security::setHash('SHA1');

abstract class AppController extends Controller {
	
    public $layout = "administrator"; #layout file for all administraive panel
    
    public $helpers =array('Html','Form','Session','Javascript','Time','Text','Tree');

    public $components = array(
    	'Auth',
    	'Session',
    	'Cookie',
    	'RequestHandler',
    	'Security',
    	'DebugKit.Toolbar'
    );
    
    
    
    public function beforeFilter() {
    	
    	$this->autoLogoutMessage();
		
        $this->Auth->fields = array(
            'username' => 'username',
            'password' => 'password'
        );
		$this->Auth->allow('register','login');
        
        #$this->Auth->userScope = array('User.is_active' => 1);
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
                $this->Session->setFlash('You have been logged out due to inactivity');
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
    	return ClassRegistry::init('Implementation')->find(
    		'list',array(
    			'fields'=>array(
    				'id',
    				'name'),
    			'contain'=>false
    		));
    }


	public function redirect_if_not_ajax_request($address='index'){
		if(!$this->RequestHandler->isAjax()){
			$this->redirect($address);
		}
	}

	public function redirect_if_id_is_empty($id,$address='index'){
		if (empty($id)) {
			$this->redirect($address);
		}
	}
	
	public function getFieldClassType($field_id){
		
		$field = ClassRegistry::init('Field')->read(null,$field_id);
		return $field['Field']['field_type_class_name'];
	}		
}
?>