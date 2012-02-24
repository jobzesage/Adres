<?php
  $csv->addGrid($data['data'], true , array_keys($data['fields']));
  echo $csv->render(true);
