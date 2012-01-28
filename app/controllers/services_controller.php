<?php


#add service authentication first

class ServicesController extends AppController{

    public $uses = array('ContactSet');
    public $layout = 'api';

    public $options = array();

    public function beforeFilter()
    {
        parent::beforeFilter();
        //$this->disableDebugger();
        $this->Auth->allow('*');
        $this->verifyApiKey();
    }

    public function index($id=null)
    {
        //if( $this->RequestHandler->ext != 'json')
            debug($this->ContactSet->getContactSet($id));
    }

    public function show($id=null)
    {
	}

	public function create($data)
	{
	}

	public function update($data)
	{
	}

	public function delete()
	{
    }

    private function verifyApiKey()
    {
        if($this->params['url']['api_key']==$this->Auth->user('api_key')){
            return true;
        }else{

        }
    }




}
