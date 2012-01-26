<?php


#add service authentication first

class ServicesController extends AppController{

    public $uses = array('User','ContactSet');

    public function beforeFilter()
    {
      $this->disableDebugger();
    }

    public function index($contact_type_id=null)
    {
        $this->layout = 'api';
        if( $this->RequestHandler->ext == 'json')
        {
            $this->set('data', $this->params['url']);
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
}
