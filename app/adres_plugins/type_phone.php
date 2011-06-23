<?php

App::import('Model','Plugin');

class TypePhone extends Plugin{ 
    
    public $useTable='type_string';

	public $_adresValidate=array(
        'notEmptyFields'=>array(
            'rule'=>'notEmpty',
            'message'=>'field can not be blank'    
        ),
        // add phone validation
        'phone'=>array(
            'rule'=>'phone',
            'message'=>'not a valid phone number'
        )
    );	    

}
