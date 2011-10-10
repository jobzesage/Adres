<?php


#add service authentication first

class ServicesController extends AppController{
	
	public $uses=array('Contact');

	
	public function show($id=null)
	{
		debug($this->Contact->getContact(1,array()));
		die();
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