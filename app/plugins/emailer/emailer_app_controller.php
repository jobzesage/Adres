<?php


class EmailerAppController extends AppController
{
    const chimp_api_key = "7fcd097cd60a760d9a04b44c64506ed5-us4";

    public function beforeFilter(){
      $this->Auth->allow('*');
      parent::beforeFilter();
    }
}
