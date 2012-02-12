<?php
class MainController extends CsvAppController{
    public $uses = array();
    public function view($id=null){
        $this->layout=null;
        $this->disableDebugger();
        $key = Configure::read('ADres.internal_api_key');
        $data = (array) $this->get_api("/v1/index/{$this->params['pass'][0]}.json?api_key={$key}");
        $this->set(compact('data'));
    }
}

