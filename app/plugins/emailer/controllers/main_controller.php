<?php
require_once dirname(__FILE__).'/../vendors/Mchimp/chimp.php';

class MainController extends EmailerAppController{
    public $uses = array();
    private $chimp = null;

    public function index(){
      $this->chimp = new Chimp(EmailerAppController::chimp_api_key);
      $message = array(
        'text'=>"This is an awesomr text",
        'subject'=>"Sending via adres",
        'from_name'=>"Rajib Ahmed",
        'to_email'=>array("l.rajibahmed@gmail.com","monir.ict@gmail.com"),
        'form_email'=>'rajib@d32.com.bd'
      );

      debug($this->chimp->sendEmail($message));
      debug($this->chimp->errorCode);
    }

    public function view($id=null){


    }


}

