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
		return $this->key;
    }

	/**
	 * This method is called after the records are fetched from the database
	 * this a hook method to modify data while displaying
	 *
	 * @return void
	 * @author Rajib Ahmed
	 **/
    public function after($dataum){
    	$encryptor_keys = $_SESSION['Contact']['encrytor_key'];
    	$key = array_keys($dataum['data']);
    	$encrypt_data = array_values($dataum['data']);

		if(is_array($encryptor_keys) && !empty($encryptor_keys)){
			if(array_key_exists($dataum['field_id'],$encryptor_keys)){
				$encryptor_key = $_SESSION['Contact']['encrytor_key'][$dataum['field_id']]['key'];
				$this->setKey($encryptor_key);
			}
		}
        $output = $this->convert($encrypt_data[0]);  
        return array($key[0]=>$output);
    }

	
    public function convert($data){
		if($this->getKey()){
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
    
   	
   	/**
   	 * This takes the form field and sets to the input property
   	 *
   	 * @param array $form 
   	 * @return void
   	 * @author Rajib Ahmed
   	 */
	protected function _setInputData($form){
		parent::_setInputData($form);
		
		$array=array('field_id'=>$this->_field_id,'contact_type_id'=>$_SESSION['Contact']['contact_type_id']);
		$stored_key = ClassRegistry::init($this->optionsClass)->getField($array);
		$this->setKey($stored_key[$this->optionsClass]['hash']);
		$this->_input = $this->encrypt($this->_input);
	}
}