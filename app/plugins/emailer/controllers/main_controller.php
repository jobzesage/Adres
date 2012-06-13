<?php
require_once dirname(__FILE__).'/../vendors/Mchimp/chimp.php';

class MainController extends EmailerAppController{
    public $uses = array('EmailLog','ContactType');
    private $chimp = null;

    public function index(){
      $this->chimp = new Chimp(EmailerAppController::chimp_api_key);
      debug($this->chimp->listVerifiedEmailAddresses());
    }

    public function view($id=null){
        $this->layout=null;
        #$this->disableDebugger();
        $field_id = $this->params['named']['field_id'];
        $contact_type_id = $this->params['pass'][0];
        $key = Configure::read('ADres.internal_api_key');
        $url = "/v1/index/{$contact_type_id}.json?api_key={$key}";
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
                'sent_to'=> implode(',',$email_addresses),
                'field_id'=> $field_id,
                'contact_type_id'=>$contact_type_id
            ));
            $this->chimp->sendEmail($message,true,false,array('Welcome Email'));
        }
        $this->redirect($this->referer(), null, true);
    }


    public function show($id=null)
    {
        if(!$id){
            $this->set('contact_types', $this->ContactType->find('all'));
        }else{
           $logs=$this->EmailLog->find('all',array('conditions'=>array(
                'contact_type_id'=> 0
            )));
           $this->set('logs', $logs);
        }
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
