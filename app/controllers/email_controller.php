<?php  

class EmailController extends AppController
{
	public $uses=null;
	
	public function check()
	{
        $this->SwiftMailer->smtpType = 'tls';
        $this->SwiftMailer->smtpHost = 'smtp.gmail.com';
        $this->SwiftMailer->smtpPort = 465;
        $this->SwiftMailer->smtpUsername = 'kislu.d32@gmail.com';
        $this->SwiftMailer->smtpPassword = '123456!!';

        $this->SwiftMailer->sendAs = 'html';
        $this->SwiftMailer->from = 'kislu.d32@gmail.com';
        $this->SwiftMailer->fromName = 'adres';
        $this->SwiftMailer->to = 'rajib@d32.com.bd';
        //set variables to template as usual
        $this->set('message', 'My message');
        
        try {
            if(!$this->SwiftMailer->send('im_excited', 'My subject')) {
                $this->log("Error sending email");
            }
        }
        catch(Exception $e) {
              $this->log("Failed to send email: ".$e->getMessage());
        }
        $this->redirect($this->referer(), null, true);
	}
}
?>