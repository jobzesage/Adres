<?php  

App::import('Model','Plugin');

class TypeString extends Plugin {
	
	public $actsAs=array('Containable');
	
	public $useTable='type_string';
	
	
    public function search($keys=array())
    {
      $field = $this->getDisplayFieldName();
      return $this->find('all', array(
	        'conditions'=>array(
	        "$field REGEXP"=> "^$keys[term]",
	        'field_id'=>$keys['fields'] 
	      ),
			'limit'=>10,
			'order'=>$field
	    ));
    }	
		
}
?>