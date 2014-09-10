<?php namespace models;
use Illuminate\Database\Capsule\Manager as Capsule;

class Event extends \core\model {
  function __construct(){
	   parent::__construct();
	}

  public function getEvent($id) {
    return Capsule::table('Event')->where('id', '=', $id)->get();
  }
  
  public function getEventsAll() {
    return Capsule::table('Event')->get();
  }
  
  public function isOneDay($id) {
    $event = $this->getEvent($id);
    return date("Y-m-d", strtotime($data['event'][0]['startTime'])) == date("Y-m-d", strtotime($data['event'][0]['endTime']));
  }
}