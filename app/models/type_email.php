<?php  
App::import('Model','Plugin');

class TypeEmail extends Plugin{
    public $useTable = 'type_email';     

    protected $_adresValidate=array(
        'email'=>array(
            'rule'=>'regex',
            'message'=>'Email is not validate',
            'pattern'=>'/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/'    
        ),
        'emailNotEmpty'=>array(
            'rule'=>'notEmpty',
            'message'=>'Email can not be blank'    
        )        
    );


}
?>
