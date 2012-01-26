<?php

	Router::parseExtensions('json','js','csv');

	Router::connect('/', 			array('controller' => 'users', 'action' => 'login'));

	Router::connect('/login',		array('controller' => 'users', 'action' => 'login'));

	Router::connect('/register',	        array('controller' => 'users', 'action' => 'register'));

	Router::connect('/my_home',	        array('controller' => 'users', 'action' => 'home'));

	// changed the data structure routes for easy user understanding
	Router::connect('/data_structure/:action',	array('controller' => 'fields','action'=>'index'));

        //need to create an api for this application
        Router::connect('/v1/contacts/:contact_type_id', array('controller'=>'services','action'=>'index'))

	// Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
?>
