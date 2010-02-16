<?php


	Router::connect('/', 			array('controller' => 'users', 'action' => 'login'));
	Router::connect('/login',		array('controller' => 'users', 'action' => 'login'));
	Router::connect('/register',	array('controller' => 'users', 'action' => 'register'));

	#Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
?>