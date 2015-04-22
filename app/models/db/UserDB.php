<?php namespace models\db;
use \models\gen\ModelClass as Model;

class UserDB implements \models\gen\ModelInterface {
	protected $db;
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
		$model = new Model();
		$this->db = $model->getDb();
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

	public function save() {
		$obj = self::getObj($this->id);
		$data = array('username' => $this->username, 'password' => $this->password, 'auth' => $this->auth, 'acl' => $this->acl, 'hash' => $this->hash, 'timestamp' => $this->timestamp);		if($obj) {//update
			$this->db->update("User",$data,array('id' => $this->id));
			return $this->id;
		} else {//insert
			$this->db->insert("User",$data);
			$obj = self::getObj("select * from User where username = :username AND password = :password AND auth = :auth AND acl = :acl AND hash = :hash AND timestamp = :timestamp",array(':username' => $this->username, ':password' => $this->password, ':auth' => $this->auth, ':acl' => $this->acl, ':hash' => $this->hash, ':timestamp' => $this->timestamp));
			return $obj->id;
		}
	}

	//////////////////////////////////////////////////////////////////////////////
	public static function getObj($sql,$params = array()) {
		$model = new Model();
		$db = $model->getDb();
		if(\is_numeric($sql) == 'integer') {
			$obj = $db->select('select * from User where id = :id limit 1', array(':id' => $sql));
		} else {
			$obj = $db->select($sql . ' limit 1',$params);
		}
		return $obj ? new \models\User($obj[0]) : null;
	}

	public static function getObjs($sql,$params = array()) {
		$model = new Model();
		$db = $model->getDb();
		$objs = $db->select($sql,$params);
		$output = array();
		foreach( $objs as $obj ) {
			$output[] = new \models\User($obj);
		}
		return $output;
	}

	public static function getObjsAll() {
		return self::getObjs('select * from User');
	}

	public static function getObjById($id) {
		return self::getObj('select * from User where id = :id',array(':id' => $id));
	}

	public static function getObjsById($id) {
		return self::getObjs('select * from User where id = :id',array(':id' =>$id));
	}

	public static function getObjByUsername($username) {
		return self::getObj('select * from User where username = :username',array(':username' => $username));
	}

	public static function getObjsByUsername($username) {
		return self::getObjs('select * from User where username = :username',array(':username' =>$username));
	}

	public static function getObjByPassword($password) {
		return self::getObj('select * from User where password = :password',array(':password' => $password));
	}

	public static function getObjsByPassword($password) {
		return self::getObjs('select * from User where password = :password',array(':password' =>$password));
	}

	public static function getObjByAuth($auth) {
		return self::getObj('select * from User where auth = :auth',array(':auth' => $auth));
	}

	public static function getObjsByAuth($auth) {
		return self::getObjs('select * from User where auth = :auth',array(':auth' =>$auth));
	}

	public static function getObjByAcl($acl) {
		return self::getObj('select * from User where acl = :acl',array(':acl' => $acl));
	}

	public static function getObjsByAcl($acl) {
		return self::getObjs('select * from User where acl = :acl',array(':acl' =>$acl));
	}

	public static function getObjByHash($hash) {
		return self::getObj('select * from User where hash = :hash',array(':hash' => $hash));
	}

	public static function getObjsByHash($hash) {
		return self::getObjs('select * from User where hash = :hash',array(':hash' =>$hash));
	}

	public static function getObjByTimestamp($timestamp) {
		return self::getObj('select * from User where timestamp = :timestamp',array(':timestamp' => $timestamp));
	}

	public static function getObjsByTimestamp($timestamp) {
		return self::getObjs('select * from User where timestamp = :timestamp',array(':timestamp' =>$timestamp));
	}

}
