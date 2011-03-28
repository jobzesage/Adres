<?php

class MailerController extends AppController{
	
	public $uses = array('TypeEmail');
	
	public function send($field_id=null){
		
        $addresses = $this->TypeEmail->find('all',array('conditions'=>array(
            'field_id'=>$field_id
        ))) ;
        $email_addresses = array();
        $email_addresses = Set::extract('/TypeEmail/'.$this->TypeEmail->getDisplayFieldName(),$addresses);
        if (!empty($email_addresses)) {
           $email_addresses = array_unique($email_addresses); 
        }

        $this->SwiftMailer->smtpType = 'tls';
        $this->SwiftMailer->smtpHost = 'smtp.gmail.com';
        $this->SwiftMailer->smtpPort = 465;
        $this->SwiftMailer->smtpUsername = 'kislu.d32@gmail.com';
        $this->SwiftMailer->smtpPassword = '123456!!';

        $this->SwiftMailer->sendAs = 'html';
        $this->SwiftMailer->from = 'noone@d32.com';

        $this->SwiftMailer->fromName = 'ADres';
        
        if(isset($this->data['Mailer']['from'])) {
            $this->SwiftMailer->fromName = $this->data['Mailer']['from'];
        }
        
        $this->SwiftMailer->to = $email_addresses; 

        //set variables to template as usual
        $this->set('message', $this->data['Mailer']['message']);
        $subject = $this->data['Mailer']['subject'];
        try {
            if(!$this->SwiftMailer->batchSend($subject)) {
                $this->log("Error sending email");
            }
        }
        catch(Exception $e) {
              $this->log("Failed to send email: ".$e->getMessage());
        }
        
        $this->Session->setFlash("You save sent mails to <br/> ". implode(',',$email_addresses));
        $this->redirect($this->referer(), null, true);
     }



    public function open_message($id=null)
    {
		$this->layout = 'default';
		$status=true;
		$this->set(compact('id','status')); 
    }
}
?>
