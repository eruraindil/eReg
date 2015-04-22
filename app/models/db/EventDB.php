<?php namespace models\db;
use \models\gen\ModelClass as Model;

class EventDB implements \models\gen\ModelInterface {
	protected $db;
	protected $id;
	protected $name;
	protected $startTime;
	protected $endTime;
	protected $cost;
	protected $maxAttendance;
	protected $location;
	protected $description;

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

	public function save() {
		$obj = self::getObj($this->id);
		$data = array('name' => $this->name, 'startTime' => $this->startTime, 'endTime' => $this->endTime, 'cost' => $this->cost, 'maxAttendance' => $this->maxAttendance, 'location' => $this->location, 'description' => $this->description);		if($obj) {//update
			$this->db->update("Event",$data,array('id' => $this->id));
			return $this->id;
		} else {//insert
			$this->db->insert("Event",$data);
			$obj = self::getObj("select * from Event where name = :name AND startTime = :startTime AND endTime = :endTime AND cost = :cost AND maxAttendance = :maxAttendance AND location = :location AND description = :description",array(':name' => $this->name, ':startTime' => $this->startTime, ':endTime' => $this->endTime, ':cost' => $this->cost, ':maxAttendance' => $this->maxAttendance, ':location' => $this->location, ':description' => $this->description));
			return $obj->id;
		}
	}

	//////////////////////////////////////////////////////////////////////////////
	public static function getObj($sql,$params = array()) {
		$model = new Model();
		$db = $model->getDb();
		if(\is_numeric($sql) == 'integer') {
			$obj = $db->select('select * from Event where id = :id limit 1', array(':id' => $sql));
		} else {
			$obj = $db->select($sql . ' limit 1',$params);
		}
		return $obj ? new \models\Event($obj[0]) : null;
	}

	public static function getObjs($sql,$params = array()) {
		$model = new Model();
		$db = $model->getDb();
		$objs = $db->select($sql,$params);
		$output = array();
		foreach( $objs as $obj ) {
			$output[] = new \models\Event($obj);
		}
		return $output;
	}

	public static function getObjsAll() {
		return self::getObjs('select * from Event');
	}

	public static function getObjById($id) {
		return self::getObj('select * from Event where id = :id',array(':id' => $id));
	}

	public static function getObjsById($id) {
		return self::getObjs('select * from Event where id = :id',array(':id' =>$id));
	}

	public static function getObjByName($name) {
		return self::getObj('select * from Event where name = :name',array(':name' => $name));
	}

	public static function getObjsByName($name) {
		return self::getObjs('select * from Event where name = :name',array(':name' =>$name));
	}

	public static function getObjByStartTime($startTime) {
		return self::getObj('select * from Event where startTime = :startTime',array(':startTime' => $startTime));
	}

	public static function getObjsByStartTime($startTime) {
		return self::getObjs('select * from Event where startTime = :startTime',array(':startTime' =>$startTime));
	}

	public static function getObjByEndTime($endTime) {
		return self::getObj('select * from Event where endTime = :endTime',array(':endTime' => $endTime));
	}

	public static function getObjsByEndTime($endTime) {
		return self::getObjs('select * from Event where endTime = :endTime',array(':endTime' =>$endTime));
	}

	public static function getObjByCost($cost) {
		return self::getObj('select * from Event where cost = :cost',array(':cost' => $cost));
	}

	public static function getObjsByCost($cost) {
		return self::getObjs('select * from Event where cost = :cost',array(':cost' =>$cost));
	}

	public static function getObjByMaxAttendance($maxAttendance) {
		return self::getObj('select * from Event where maxAttendance = :maxAttendance',array(':maxAttendance' => $maxAttendance));
	}

	public static function getObjsByMaxAttendance($maxAttendance) {
		return self::getObjs('select * from Event where maxAttendance = :maxAttendance',array(':maxAttendance' =>$maxAttendance));
	}

	public static function getObjByLocation($location) {
		return self::getObj('select * from Event where location = :location',array(':location' => $location));
	}

	public static function getObjsByLocation($location) {
		return self::getObjs('select * from Event where location = :location',array(':location' =>$location));
	}

	public static function getObjByDescription($description) {
		return self::getObj('select * from Event where description = :description',array(':description' => $description));
	}

	public static function getObjsByDescription($description) {
		return self::getObjs('select * from Event where description = :description',array(':description' =>$description));
	}

}
