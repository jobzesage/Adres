<?php


#add service authentication first

class ServicesController extends AppController{

    public $uses = array('User','ContactSet');

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->disableDebugger();
        $this->Auth->allow('*');
    }

    public function index($contact_type_id=null)
    {
        $this->layout = 'api';
        if( $this->RequestHandler->ext == 'json')
        {
            $this->set('data', array('fields'=>array('Name','Age'), 'data'=>array(array('Rajib','28'),array('Utpol','27'))));
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
