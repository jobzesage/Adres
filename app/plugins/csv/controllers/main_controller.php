<?php
class MainController extends CsvAppController{
    public $uses = array();
    public function display(){
        $this->layout=null;
        $this->disableDebugger();
        $data = (array) $this->get_api('/v1/contacts/1.json');
        $this->set(compact('data'));
    }
}

