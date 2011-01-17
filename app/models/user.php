<?php
class User extends AppModel {

	public $name = 'User';

	public $actsAs = array('Containable');
	
	// public $validate = array(
	// 	'first_name' => array('notempty'),
	// 	'last_name' => array('notempty'),
	// 	'username' => array('notempty'),
	// 	'email' => array('email'),
	// 	'password' => array('notempty'),
	// 	'is_active' => array('numeric')
	// );
	
/*
	public $validate = array( 
		'email' => array(
			'rule1' => array(
				'rule' => 'notEmpty',
				'message' => 'Email can not be blank', 
			), 
			'rule2' => array(
				'rule' => 'email', 
				'last'=>true,
				'message' => 'Must be a valid email address', 
			),
			'rule3' => array(
				'rule' => "isUnique", 
				'message'=>"This email address is alredy registered"
			) 
		),
		'first_name' => array(
			'rule1' => array(
				'rule' => 'notEmpty',
				'message' => 'Please provide your first name',  
			),
			'rule2' => array(
				'rule' => array('minLength', '2'),
				'message' => 'Mimimum 2 characters long'
			)  
		), 	
		'last_name' => array(
			'rule1' => array(
				'rule' => 'notEmpty',
				'message' => 'Please provide your last name',  
			),
			'rule2' => array(
				'rule' => array('minLength', '2'),
				'message' => 'Mimimum 2 characters long'
			)  
		),
		'password' => array(
			'rule1' => array(
				'rule' => array('minLength',4),
				'message' => "Password should be more than 4 characters"
			)
		) 
	);


*/
		
	public $hasMany = array(
		'Log' => array(
			'className' => 'Log',
			'foreignKey' => 'user_id'
		),
		'HiddenField'=>array(
			'className' => 'HiddenField'
		)
	);
	
	
	public function getHiddenFieldsByContactType($contact_type_id)
	{
		$hidden_fields = $this->find('first',array(
			'contain' => array(
				'HiddenField'=>array(
					'conditions'=>array(
						'HiddenField.contact_type_id' => $contact_type_id,
						'HiddenField.user_id'=>$this->id 
					)
				)
			)
		));
		
		return Set::extract('/HiddenField/field_id',$hidden_fields);
	}
}
?>