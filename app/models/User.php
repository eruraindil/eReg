<?php namespace models;

class User extends \models\db\RegistrantDB {
  function __construct( $fields ){
	   parent::__construct( $fields );
	}

  public function getUser($username) {
    //return Capsule::table('User')->where('username', '=', $username)->get();
  }
}
