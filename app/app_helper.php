<?php

App::import('Helper', 'Helper', false);

class AppHelper extends Helper {
	
    public function getPluginName($className){
    	return 'Type'.ucwords($className);				
    }
    
}
?>
