<?php
class User extends AppModel {

	public $name = 'User';

	public $actsAs = array('Containable');
	
	public $validate = array(
		'first_name' => array('notempty'),
		'last_name' => array('notempty'),
		'username' => array('notempty'),
		'email' => array('email'),
		'password' => array('notempty'),
		'is_active' => array('numeric')
	);
	
		
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