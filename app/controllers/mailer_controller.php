<?php

class MailerController extends AppController{

	public $uses = array('TypeEmail');

	public function send($field_id=null){


        $this->redirect($this->referer(), null, true);
     }



    public function open_message($id=null)
    {
		$this->layout = 'default';
		$status=true;
		$this->set(compact('id','status'));
    }
}
