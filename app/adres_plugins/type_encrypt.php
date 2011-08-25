<?php

App::import('model','Plugin');

class TypeEncrypt extends Plugin{
    public $useTable = "type_encrypt";
    
    public $optionsClass = "TypeEncryptOption";
    
    private $key = null;
    private $vi  = null;
    

    public function setKey($key){
        $this->key = $key;
    }
    
    private function getVI(){
      if(empty($this->vi)){
        $this->vi = Configure::read('ADres.encryptor_vi');
      }
      return $this->vi;
    }

    private function getKey(){
		if(!empty($_SESSION['Contact']['encrytor_key'])){
			return $_SESSION['Contact']['encrytor_key'];				
		}else{
			return $this->key;
		}
    }

    public function after($dataum){
		$encrypt_data = array_values($dataum['data']);
		$key = array_keys($dataum['data']);
        $output = $this->convert($encrypt_data[0]);  
        return array($key[0]=>$output);
    }

    public function convert($data){
    	if(!empty($_SESSION['Contact']['encrytor_key'])){
       		 return $this->decrypt($data);            
   		}
   		return $data;
    }

    public function encrypt($data,$options=array()){
   		return openssl_encrypt($data,'aes-128-cbc',$this->getKey(), false, $this->getVI());
    }


    public function decrypt($data,$options=array()){
       return openssl_decrypt($data,'aes-128-cbc',$this->getKey(), false, $this->getVI());
    }
    
	protected function _setInputData($form){
		parent::_setInputData($form);
		
		$array=array('field_id'=>$this->_field_id,'contact_type_id'=>$_SESSION['Contact']['contact_type_id']);
		$stored_key = ClassRegistry::init($this->optionClass)->getField($array);
		
		$this->setKey($stored_key[0][$this->optionClass]['hash']);
		$this->_input = $this->encrypt($this->_input);
	}

}