<?php


class EmailerAppController extends AppController
{
    const chimp_api_key = "ffb13bbacec005ee912ddbd7bb04540e-us4";

    public function beforeFilter(){
      $this->Auth->allow('*');
      parent::beforeFilter();
    }
}
