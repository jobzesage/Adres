<?php


#add service authentication first

class ServicesController extends AppController{

    public $uses = array('ContactSet','Field');
    public $layout = 'api';

    public $options = array();

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->disableDebugger();
        $this->Auth->allow('*');
    }

    public function api_index($id=null)
    {
        //if( $this->RequestHandler->ext == 'json')
        $this->layout = 'api';
        $data = $this->ContactSet->getContactSet($id,$this->setContactSet(array('toJSON'=>true), $id));
        $this->set(compact('data'));
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
