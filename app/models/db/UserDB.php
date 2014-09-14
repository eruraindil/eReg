<?php namespace models\db;
use \core\model as Model;

class UserDB implements \models\gen\ModelInterface {
	protected $id;
	protected $username;
	protected $password;
	protected $auth;
	protected $acl;
	protected $hash;
	protected $timestamp;

	function __construct( $fields = null ){
		foreach( $fields as $key => $value ) {
			$this->$key = $value;
		}
	}

	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function getUsername() {
		return $this->username;
	}
	public function setUsername($username) {
		$this->username = $username;
	}
	public function getPassword() {
		return $this->password;
	}
	public function setPassword($password) {
		$this->password = $password;
	}
	public function getAuth() {
		return $this->auth;
	}
	public function setAuth($auth) {
		$this->auth = $auth;
	}
	public function getAcl() {
		return $this->acl;
	}
	public function setAcl($acl) {
		$this->acl = $acl;
	}
	public function getHash() {
		return $this->hash;
	}
	public function setHash($hash) {
		$this->hash = $hash;
	}
	public function getTimestamp() {
		return $this->timestamp;
	}
	public function setTimestamp($timestamp) {
		$this->timestamp = $timestamp;
	}

	//////////////////////////////////////////////////////////////////////////////
	public static function getObj($id) {
		$model = new Model();
		$db = $model->getDb();
		return $db->select('select * from User where id = :id', array(':id' => $id));
	}

	public static function getObjs($sql) {
		$model = new Model();
		$db = $model->getDb();
		$objs = $db->select($sql);
		$output = array();
		foreach( $objs as $obj ) {
			$output[] = new \models\User($obj);
		}
		return $output;	}

	public static function getObjsAll() {
		return self::getObjs('select * from User');
	}

}
