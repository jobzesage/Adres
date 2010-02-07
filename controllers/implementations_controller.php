<?php
class ImplementationsController extends AppController {

        
    public function index() { 
        $this->set('implemetations',$this->Implementation->find());  
    
    }

    public function add() { 
        if($this->data){
            //place some scaffolding here    
        

        }else{
        
        
        }
    }
    
    public function edit($id=null) {   }
    
    public function delete($id=null) {   }
}
?>
