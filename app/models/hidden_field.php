<?php  
class HiddenField extends AppModel {
	public $actsAs = array('Containable');	
	public $name = 'HiddenField';
	public $belongsTo = array('User' => array('className' => 'User', 'foreignKey' => 'user_id'));
	 	
}
?>