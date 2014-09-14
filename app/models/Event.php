<?php namespace models;
use models\Registration as Registration;

class Event extends \models\db\EventDB {
  function __construct( $fields ){
	   parent::__construct( $fields );
	}
  
  public function isOneDay() {
    return date("Y-m-d", strtotime($this->startTime)) == date("Y-m-d", strtotime($this->endTime));
  }
  
  public function isFull() {
    return count($this->getCurAttendance()) == $this->maxAttendance;
  }
  
  public function getCurAttendance() {
    $registrations = Registration::getObjsByEvent($this->id);
    return count($registrations);
  }
}