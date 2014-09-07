<?php namespace models;
use Illuminate\Database\Capsule\Manager as Capsule;

class Users extends \core\model {
  function __construct(){
	   parent::__construct();
	}

  public function getUser($username) {
    return Capsule::table('users')->where('username', '=', $username)->get();
  }
}
