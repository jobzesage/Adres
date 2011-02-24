<?php  
App::import('Model','Plugin');

class TypeEmail extends Plugin{
    public $useTable = 'type_email';     

    protected $_adresValidate=array(
        'email'=>array(
            'rule'=>'regex',
            'message'=>'Email is not validate',
            'pattern'=>'/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/'    
        ),
        'emailNotEmpty'=>array(
            'rule'=>'notEmpty',
            'message'=>'Email can not be blank'    
        )        
    );


}
?>
