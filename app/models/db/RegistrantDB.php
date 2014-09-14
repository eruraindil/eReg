<?php namespace models\db;
use \core\model as Model;

class RegistrantDB implements \models\gen\ModelInterface {
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

	//////////////////////////////////////////////////////////////////////////////
	public static function getObj($id) {
		$model = new Model();
		$db = $model->getDb();
		return $db->select('select * from Registrant where id = :id', array(':id' => $id));
	}

	public static function getObjs($sql) {
		$model = new Model();
		$db = $model->getDb();
		$objs = $db->select($sql);
		$output = array();
		foreach( $objs as $obj ) {
			$output[] = new \models\Registrant($obj);
		}
		return $output;	}

	public static function getObjsAll() {
		return self::getObjs('select * from Registrant');
	}

}
