<?php namespace models\db;
use \core\model as Model;

class EventDB implements \models\db\ModelInterface {
  
  protected $id;
  protected $name;
  protected $startTime;
  protected $endTime;
  protected $cost;
  protected $curAttendance;
  protected $maxAttendance;
  protected $description;
  protected $location;
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
  
  //////////////////////////////////////////////////////////////////////////////
  public static function getObj($id) {
    $model = new Model();
    $db = $model->getDb();
    return $db->select("select * from Event where id = :id", array(":id" => $id));
  }
  
  public static function getObjs($sql) {
    $model = new Model();
    $db = $model->getDb();
    $objs = $db->select($sql);
    
    $output = array();
    foreach( $objs as $obj ) {
      $output[] = new \models\Event($obj);
    }
    return $output;
  }
  
  public static function getObjsAll() {
    return self::getObjs("select * from Event");
  }
}
