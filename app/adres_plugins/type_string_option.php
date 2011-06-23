<?php

class TypeStringOption{

    private static $tso;

    private function __construct(){
    
    }

    public static function getInstrance(){
        if(!isset(self::$tso)){
            self::$tso = new TypeStringOption;
        } 
        return self::$tso;
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
