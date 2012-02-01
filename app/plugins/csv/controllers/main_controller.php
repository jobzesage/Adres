<?php
class MainController extends CsvAppController{
    public $uses = array();
    public function view($id=null){
        $this->layout=null;
        $this->disableDebugger();
        $data = (array) $this->get_api("/v1/index/{$this->params['pass'][0]}.json");
        $this->set(compact('data'));
    }
}

