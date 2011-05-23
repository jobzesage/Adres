<?php

App::import('model','Plugin');
  
class TypeEncrypt extends Plugin{
    public $useTable = "type_encrypt";

    private $key = null;

    public function setKey($key){
        $this->key = $key;
    }


    public function after($dataum){
        return $this->convert_to_readable($dataum);
    }

    public function convert_to_readable($data){
        return $data;
    }

    public function encrypt($data,$options=array()){
        return $data;
    }


    public function decrypt($data,$options=array()){
       return $data; 
    }

 
}
