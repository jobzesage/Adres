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


}
