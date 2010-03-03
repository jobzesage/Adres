<?php
    
	Router::parseExtensions('json','js');

	Router::connect('/', 			array('controller' => 'users', 'action' => 'login'));
	
	Router::connect('/login',		array('controller' => 'users', 'action' => 'login'));
	
	Router::connect('/register',	array('controller' => 'users', 'action' => 'register'));
	
	Router::connect('/my_home',	array('controller' => 'users', 'action' => 'home'));
	
	// changed the data structure routes for easy user understanding
	Router::connect('/data_structure/:action',	array('controller' => 'fields','action'=>'index'));
	#Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
?>