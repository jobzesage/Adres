<?php
class User extends AppModel {


    public $validate = array(
        'email' => array(
            'email' => array(
                'rule' => 'email'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                #'message' => __('Specified email is already registered',true),
                'last' => true
            )
         ),
        'first_name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                #'message'=>__('First Name is required',true)
            ),
        ),
        'last_name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                #'message'=>__('Last Name is required',true)
            )
        ),
        'username' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                #'message'=>__('Username can not be blank',true)
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'last' => true
            )
        ),
        'password' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                #'message'=>__('Password can not be blank',true)
            )
        ),
        'zip' => array(
            'rule' => array('isValidUSAZip'),
            'required' => false,
            'allowEmpty' => true,
            'message' => 'Allowed formats are: ZIP and ZIP+4'
        )
    );
 

    public function afterSave() {
        #TODO have to save a token and user id on token table
        #$this->
    }
    
    
}
?>
