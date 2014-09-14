<?php namespace models;

class User extends \models\db\UserDB {
  function __construct( $fields ){
	   parent::__construct( $fields );
	}
}
