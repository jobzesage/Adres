<?php

class MainController extends AwSesAppController{
    public $uses = array('EmailLog','ContactType');
    private $aw_ses = null;

    public function index(){

        $message = array(
            "Subject.Data"=>"My Subject".time(),
            "Body.Text.Data"=>"My Mail body" .time());

        $res = $this->aw_ses->send_email('jonathan@mybigler.com',array(
             'ToAddresses'=>array('cool_rajib@hotmail.com')
         ),$message
        );

        echo "<pre>";
        var_dump($res);
        echo "</pre>";
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
            $this->aw_ses = new AmazonSES();

            $message = array(
                "Subject.Data"=>$this->data['Mailer']['subject'],
                "Body.Text.Data"=>$this->data['Mailer']['message'],
                "Body.Html.Data"=>$this->data['Mailer']['message']
            );

            $res = $this->aw_ses->send_email('jonathan@mybigler.com',array(
                'ToAddresses'=>$email_addresses),$message);

            if($res->isOk()){
                $this->EmailLog->save(array(
                    'body'=>$this->data['Mailer']['message'],
                    'subject'=>$this->data['Mailer']['subject'],
                    'sent_to'=> implode(',',$email_addresses),
                    'field_id'=> $field_id,
                    'contact_type_id'=>$contact_type_id
                ));
            }

        }
        $this->redirect($this->referer(), null, true);
    }


    public function show($id=null)
    {
        if(!$id){
            $this->set('contact_types', $this->ContactType->find('all'));
        }else{
            $id = $this->params['pass'][0];
           $logs=$this->EmailLog->find('all',array('conditions'=>array(
                'contact_type_id'=> $id
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
