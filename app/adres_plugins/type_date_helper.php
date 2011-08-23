<?php
App::import('Helper','Time');
class AdresTimeHelper extends TimeHelper{
  
  public function age($date)
  {
    return $this->timeAgoInWords($date,array('end'=>'+150 years'));
  }
  
  public function ddmmyyyy($date)
  {
  	return $this->format( $format = 'd.m.Y', $date);
  }
  
}
