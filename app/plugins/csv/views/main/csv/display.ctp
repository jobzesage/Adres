<?php
$csv->addGrid($data['data'], true , $data['fields']);
echo $csv->render(true);
