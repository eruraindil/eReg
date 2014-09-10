<?php namespace models;
use Illuminate\Database\Capsule\Manager as Capsule;

class Events extends \core\model {
  function __construct(){
	   parent::__construct();
	}

  public function getEvent($id) {
    return Capsule::table('events')->where('id', '=', $id)->get();
  }
}