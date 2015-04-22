<?php namespace models\db;
use \models\gen\ModelClass as Model;

class RegistrationDB implements \models\gen\ModelInterface {
	protected $db;
	protected $id;
	protected $firstName;
	protected $lastName;
	protected $email;
	protected $birthDate;
	protected $event;

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
	public function getFirstName() {
		return $this->firstName;
	}
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}
	public function getLastName() {
		return $this->lastName;
	}
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}
	public function getEmail() {
		return $this->email;
	}
	public function setEmail($email) {
		$this->email = $email;
	}
	public function getBirthDate() {
		return $this->birthDate;
	}
	public function setBirthDate($birthDate) {
		$this->birthDate = $birthDate;
	}
	public function getEvent() {
		return $this->event;
	}
	public function setEvent($event) {
		$this->event = $event;
	}

	public function save() {
		$obj = self::getObj($this->id);
		$data = array('firstName' => $this->firstName, 'lastName' => $this->lastName, 'email' => $this->email, 'birthDate' => $this->birthDate, 'event' => $this->event);		if($obj) {//update
			$this->db->update("Registration",$data,array('id' => $this->id));
			return $this->id;
		} else {//insert
			$this->db->insert("Registration",$data);
			$obj = self::getObj("select * from Registration where firstName = :firstName AND lastName = :lastName AND email = :email AND birthDate = :birthDate AND event = :event",array(':firstName' => $this->firstName, ':lastName' => $this->lastName, ':email' => $this->email, ':birthDate' => $this->birthDate, ':event' => $this->event));
			return $obj->id;
		}
	}

	//////////////////////////////////////////////////////////////////////////////
	public static function getObj($sql,$params = array()) {
		$model = new Model();
		$db = $model->getDb();
		if(\is_numeric($sql) == 'integer') {
			$obj = $db->select('select * from Registration where id = :id limit 1', array(':id' => $sql));
		} else {
			$obj = $db->select($sql . ' limit 1',$params);
		}
		return $obj ? new \models\Registration($obj[0]) : null;
	}

	public static function getObjs($sql,$params = array()) {
		$model = new Model();
		$db = $model->getDb();
		$objs = $db->select($sql,$params);
		$output = array();
		foreach( $objs as $obj ) {
			$output[] = new \models\Registration($obj);
		}
		return $output;
	}

	public static function getObjsAll() {
		return self::getObjs('select * from Registration');
	}

	public static function getObjById($id) {
		return self::getObj('select * from Registration where id = :id',array(':id' => $id));
	}

	public static function getObjsById($id) {
		return self::getObjs('select * from Registration where id = :id',array(':id' =>$id));
	}

	public static function getObjByFirstName($firstName) {
		return self::getObj('select * from Registration where firstName = :firstName',array(':firstName' => $firstName));
	}

	public static function getObjsByFirstName($firstName) {
		return self::getObjs('select * from Registration where firstName = :firstName',array(':firstName' =>$firstName));
	}

	public static function getObjByLastName($lastName) {
		return self::getObj('select * from Registration where lastName = :lastName',array(':lastName' => $lastName));
	}

	public static function getObjsByLastName($lastName) {
		return self::getObjs('select * from Registration where lastName = :lastName',array(':lastName' =>$lastName));
	}

	public static function getObjByEmail($email) {
		return self::getObj('select * from Registration where email = :email',array(':email' => $email));
	}

	public static function getObjsByEmail($email) {
		return self::getObjs('select * from Registration where email = :email',array(':email' =>$email));
	}

	public static function getObjByBirthDate($birthDate) {
		return self::getObj('select * from Registration where birthDate = :birthDate',array(':birthDate' => $birthDate));
	}

	public static function getObjsByBirthDate($birthDate) {
		return self::getObjs('select * from Registration where birthDate = :birthDate',array(':birthDate' =>$birthDate));
	}

	public static function getObjByEvent($event) {
		return self::getObj('select * from Registration where event = :event',array(':event' => $event));
	}

	public static function getObjsByEvent($event) {
		return self::getObjs('select * from Registration where event = :event',array(':event' =>$event));
	}

}
