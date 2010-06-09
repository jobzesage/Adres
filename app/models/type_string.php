<?php  

App::import('Model','Plugin');

class TypeString extends Plugin {
	
	public $actsAs=array('Containable');
	
	public $useTable='type_string';
		
}
?>