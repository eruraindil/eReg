<?php namespace models;

class Event extends \models\db\EventDB {
  function __construct( $fields ){
	   parent::__construct( $fields );
	}
  
  public function isOneDay() {
    return date("Y-m-d", strtotime($this->startTime)) == date("Y-m-d", strtotime($this->endTime));
  }
}