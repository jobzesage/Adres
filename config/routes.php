<?php
    
    Router::parseExtensions('xml','json');

    #Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));

    Router::connect('/register', array('controller' => 'user', 'action' => 'register'));

    Router::connect('/login', array('controller' => 'users', 'action' => 'login'));

    Router::connect('/', array('controller' => 'users', 'action' => 'register' ));

    #Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
?>
