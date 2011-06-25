<?php
App::import('Model','TypeString');

class TypeStringEllipses extends TypeString {

    public $useTable='type_string_ellipses';


    //@override
    public function after($column){
        $k = array_keys($column[$this->_display_field_name]);
        $d = array_values($column[$this->_display_field_name]);
        $data = $this->addElipse($d[0]);
        return array($k[0]=>$data['modified']);
    }


    public function addElipse($text, $length = 10 ,$options=array()){
        $defaults = array('elipse'=>"....");
        $options = am($defaults, $options);
        $text_length = strlen($text);
        $cutOff = $length;
        if ( $text_length > 0 && $text_length < $length){
            $cutOff= $length -5;
        }

        $modified = substr($text, $cutOff);
        $modified.= $options['elipse'] ;

        return array('original'=>$text, 'modified'=>$modified);
     }

}
