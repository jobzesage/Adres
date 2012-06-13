<?php

App::import('Security');
Security::setHash('SHA1');

abstract class AppController extends Controller {

    public $layout = "administrator"; #layout file for all administraive panel

    public $helpers =array('Html','Form','Session','Javascript','Time','Text','Tree','Csv');

    public $components = array(
    	'Auth',
    	'Session',
    	'Cookie',
    	'RequestHandler',
    	'Security',
      	'SwiftMailer',
      	'DebugKit.Toolbar'
    );



    public function beforeFilter() {


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



    protected function getSQL(Array $criterias){
    	$where = ' ';
		foreach($criterias as $value){
			$where = $where.' AND '.$value['sql'];
		}
		return $where;
	}

    private function setImplementation(){
    	if(!$this->Session->check('Implementation')){
    		$implementation = ClassRegistry::init('Implementation')->find(
    			'first',array(
    				'fields'=>array('id','name')
    			));
			$this->Session->write('Implementation',$implementation['Implementation']);
    	}
    }

    protected function setContactSet($options = array(), $contact_type_id=null)
    {
        $options = Set::filter($options);
        if(empty($contact_type_id))
            $contact_type_id =  $this->Session->read('Contact.contact_type_id');


		$this->User->id = $this->Auth->user('id');

        $hidden_fields = array();
        if(!empty($this->User->id)){
            $hidden_fields = $this->User->getHiddenFieldsByContactType($contact_type_id);
        }

		$fields   = $this->Field->getPluginTypes($contact_type_id,$hidden_fields);

		# query optimization
		$hidden_fields_list = !empty($hidden_fields) ? $this->Field->getList($hidden_fields): array();

		$this->set('fields',$fields);

		$this->set('hidden_fields',$hidden_fields_list);

		$keyword  = "";
		$criteria = "";
		$affiliation= "";

		if($this->Session->check('Filter.criteria')){
			$criteria = $this->getSQL(unserialize($this->Session->read('Filter.criteria')));
        }

        if($this->Session->check('Filter.keyword')) $keyword = $this->Session->read('Filter.keyword');
		if($this->Session->check('Filter.affiliation')) $affiliation = $this->Session->read('Filter.affiliation');

        $search=array(
            'searchKeyword'=>$keyword,
            'filters'=>$criteria,
            'plugins'=>$fields,
            'affiliation'=>$affiliation,
            'include_trash'=> (bool) $this->Session->read('Contact.include_trash')
        );
		return am($search,$options);
    }

    protected function get_api($url){

        $curl_handle = curl_init();
        $curl_options = array(
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_URL             => Configure::read('ADres.host').$url
        );


        curl_setopt_array($curl_handle,$curl_options);
        $result = curl_exec($curl_handle);
        curl_close($curl_handle);

        return json_decode($result, true);
    }

	protected function disableDebugger(){
		if (Configure::read('debug') > 0) {
			Configure::write('debug',0);
		}
    }


}
?>
