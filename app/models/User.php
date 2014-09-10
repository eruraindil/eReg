<?php namespace models;
use Illuminate\Database\Capsule\Manager as Capsule;

class User extends \core\model {
  function __construct(){
	   parent::__construct();
	}

  public function getUser($username) {
    return Capsule::table('user')->where('username', '=', $username)->get();
  }
}
