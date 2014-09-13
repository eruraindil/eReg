<?php namespace models;
use Illuminate\Database\Capsule\Manager as Capsule;

class Registrant extends \core\model {
  function __construct(){
	   parent::__construct();
	}

  public function getRegistrant($id) {
    return Capsule::table('Registrant')->where('id', '=', $id)->get();
  }
  
  public function getRegistrantsAll() {
    return Capsule::table('Registrant')->get();
  }
  
  public function getRegistrantsAllForEvent($eventId) {
    return Capsule::table('Registrant')->where('event', '=', $eventId)->orderBy('lastName')->get();
  }
}