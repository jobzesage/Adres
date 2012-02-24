<?php
require_once dirname(__FILE__).'/../vendors/Mchimp/chimp.php';

class MainController extends EmailerAppController{
    public $uses = array();
    private $chimp = null;

    public function index(){
      $this->chimp = new Chimp(EmailerAppController::chimp_api_key);

      $to_emails = array('rajib@d32.com.bd', 'cool_rajib@hotmail.com');
      $to_names = array('You', 'Your Mom');
      $message = array(
          'html'=>'Yo, this is the <b>html</b> portion',
          'text'=>'Yo, this is the *text* portion',
          'subject'=>'This is the subject',
          'from_name'=>'Me!',
          'from_email'=>'jonathan@mybigler.com',
          'to_email'=>$to_emails,
          'to_name'=>$to_names
      );

      debug($this->chimp->sendEmail($message,true,false,array('Welcome Email')));
      debug($this->chimp->getSendStatistics());
      #debug($this->chimp->verifyEmailAddress("l.rajibahmed@gmail.com"));
    }

    public function view($id=null){
        $this->layout=null;
        #$this->disableDebugger();
        $key = Configure::read('ADres.internal_api_key');
        $data = (array) $this->get_api("/v1/index/{$this->params['pass'][0]}.json?api_key={$key}");

        $email_column = $this->extract_email_column($data['fields']);
        $email_addresses = $this->extract_email_addresses($data['data'],$email_column);
        debug($email_addresses);

        $this->render(null);
    }


    private function extract_email_column($fields){
      $field_name = null;
      foreach ($fields as $key=>$value){
        if($value['field_type_class_name']=='TypeEmail'){
          $field_name = $key;
          break;
        }
      }
      return $field_name;
    }

    private function extract_email_addresses($data,$column){
      $emails = array();
      foreach ($data as $dataum){
        $emails[] = $dataum[$column];
      }
      return $emails;
    }
}
