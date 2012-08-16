<?php

require_once  dirname(__FILE__).'/vendors/AmazonSdk/sdk.class.php';
require_once  dirname(__FILE__).'/vendors/AmazonSdk/services/ses.class.php';

class AwSesAppController extends AppController
{
    const SENDER_ADDR = 'jonathan@mybigler.com';
}
