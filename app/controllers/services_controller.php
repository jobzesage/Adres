<?php


#add service authentication first

class ServicesController extends AppController{

    public $uses = array('ContactSet','Field', 'User');
    public $layout = 'api';
    private $verified = false;

    public $options = array();

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->disableDebugger();
        $this->verifyApiKey();
        $this->Auth->allow('*');
    }

    public function api_index($id=null)
    {
        if( $this->RequestHandler->ext == 'json' && $this->verified ){
            $data = $this->ContactSet->getContactSet($id,$this->setContactSet(array('toJSON'=>true), $id));
            $this->set(compact('data'));
        }
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
        if($this->params['url']['api_key'] == Configure::read("ADres.internal_api_key")){
            $this->verified = true;
        }
    }

}
