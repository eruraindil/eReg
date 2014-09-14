<?php namespace models\db;
use \core\model as Model;

class EventDB implements \models\gen\ModelInterface {
	protected $id;
	protected $name;
	protected $startTime;
	protected $endTime;
	protected $cost;
	protected $curAttendance;
	protected $maxAttendance;
	protected $location;
	protected $description;

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
	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
	}
	public function getStartTime() {
		return $this->startTime;
	}
	public function setStartTime($startTime) {
		$this->startTime = $startTime;
	}
	public function getEndTime() {
		return $this->endTime;
	}
	public function setEndTime($endTime) {
		$this->endTime = $endTime;
	}
	public function getCost() {
		return $this->cost;
	}
	public function setCost($cost) {
		$this->cost = $cost;
	}
	public function getCurAttendance() {
		return $this->curAttendance;
	}
	public function setCurAttendance($curAttendance) {
		$this->curAttendance = $curAttendance;
	}
	public function getMaxAttendance() {
		return $this->maxAttendance;
	}
	public function setMaxAttendance($maxAttendance) {
		$this->maxAttendance = $maxAttendance;
	}
	public function getLocation() {
		return $this->location;
	}
	public function setLocation($location) {
		$this->location = $location;
	}
	public function getDescription() {
		return $this->description;
	}
	public function setDescription($description) {
		$this->description = $description;
	}

	//////////////////////////////////////////////////////////////////////////////
	public static function getObj($id) {
		$model = new Model();
		$db = $model->getDb();
		return $db->select('select * from Event where id = :id', array(':id' => $id));
	}

	public static function getObjs($sql) {
		$model = new Model();
		$db = $model->getDb();
		$objs = $db->select($sql);
		$output = array();
		foreach( $objs as $obj ) {
			$output[] = new \models\Event($obj);
		}
		return $output;	}

	public static function getObjsAll() {
		return self::getObjs('select * from Event');
	}

}
