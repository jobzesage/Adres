<?php
App::import('Helper','Time');
class AdresTimeHelper extends TimeHelper{
  
  public function age($date)
  {
    return $this->timeAgoInWords($date,array('end'=>'+150 years'));
  }
  
}
