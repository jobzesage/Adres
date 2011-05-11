<?php  
class AppError extends ErrorHandler {
  
	// public function beforeFilter(){
	// 	parent::beforeFilter();  	
	// }
	  
  	public function error404($params){
		Configure::write('debug', 1);
		//$this->controller->redirect(array('controller'=>'pages', 'action'=>'index','error'));
		// this needs to be
		if(!$this->RequestHandler->isAjax()){
			$params['message'] = "AJAX :".$params['message'];
		}
		
		$this->log(params['message']);
		parent::error404($params);
    }

  	public function error500($params){
		Configure::write('debug', 1);
		//$this->controller->redirect(array('controller'=>'pages', 'action'=>'index','error500'));
		parent::error404($params);
    }
        
    public function cannotWriteFile($params) {
		$this->controller->set('file', $params['file']);
  		$this->_outputMessage('cannot_write_file');
	}
	
}
?>