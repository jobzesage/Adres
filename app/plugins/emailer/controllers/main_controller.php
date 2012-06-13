<?php
require_once dirname(__FILE__).'/../vendors/Mchimp/chimp.php';

class MainController extends EmailerAppController{
    public $uses = array('EmailLog');
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

      #debug($this->chimp->sendEmail($message,true,false,array('Welcome Email')));
      #debug($this->chimp->verifyEmailAddress("rajib@d32.com.bd"));
      debug($this->chimp->listVerifiedEmailAddresses());
    }

    public function view($id=null){
        $this->layout=null;
        #$this->disableDebugger();
        $field_id = $this->params['named']['field_id'];
        $key = Configure::read('ADres.internal_api_key');
        $url = "/v1/index/{$this->params['pass'][0]}.json?api_key={$key}";
        $data = (array) $this->get_api($url);

        $email_column = $this->extract_email_column($data['fields'], $field_id);
        $email_addresses = Set::filter($this->extract_email_addresses($data['data'],$email_column));
        if($this->data){
            $this->chimp = new Chimp(EmailerAppController::chimp_api_key);
            $message = array(
                'text'=>$this->data['Mailer']['message'],
                'subject'=>$this->data['Mailer']['subject'],
                'from_name'=> $this->data['Mailer']['from'],
                'from_email'=>'jonathan@mybigler.com',
                'to_email'=>$email_addresses
            );

            $this->EmailLog->save(array(
                'body'=>$this->data['Mailer']['message'],
                'subject'=>$this->data['Mailer']['subject'],
                'sent_to'=> implode(',',$email_addresses)
            ));
            $this->chimp->sendEmail($message,true,false,array('Welcome Email'));
        }
        $this->redirect($this->referer(), null, true);
    }


    public function update_email_status()
    {
        // code...
    }

    private function extract_email_column($fields,$field_id){
      $field_name = null;
      foreach ($fields as $key=>$value){
          if($value['id'] == $field_id){
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
