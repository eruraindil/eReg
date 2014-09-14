<?php namespace controllers;
use \core\view as View,
		\helpers\session as Session,
		\helpers\url as Url,
    \models\Event as Event,
    \models\Registration as Registration;

class Events extends \core\controller {
  public function __construct(){
		parent::__construct();
	}
  
  public function index(){
    $data['title'] = 'Events';
    
    $data['events'] = Event::getObjsAll();

		View::rendertemplate('header',$data);
		View::rendertemplate('menu',$data);
		View::render('events/index',$data);
		View::rendertemplate('content-bottom',$data);
		View::rendertemplate('footer',$data);
  }
  
  public function create(){
    
  }
  
  public function make(){
    
  }
  
  public function edit($slug){
    if( !Session::get('username') ){
			Url::redirect('login');
  	}
    
    $data['event'] = Event::getObj($slug);
    $data['title'] = "Edit " . $data['event']->getName();
    
    $data['js'] = "CKEDITOR.replace('description');";
    $data['exjs'] = "<script src='//cdn.ckeditor.com/4.4.4/basic/ckeditor.js'></script>";

		View::rendertemplate('header',$data);
		View::rendertemplate('menu',$data);
		View::render('events/edit',$data);
		View::rendertemplate('content-bottom',$data);
		View::rendertemplate('footer',$data);
  }
  
  public function show($slug){
    $data['event'] = Event::getObj($slug);
    $data['registrations'] = Registration::getObjsByEvent($slug);
    $data['title'] = $data['event']->getName();
    
		View::rendertemplate('header',$data);
		View::rendertemplate('menu',$data);
		View::render('events/show',$data);
		View::rendertemplate('content-bottom',$data);
		View::rendertemplate('footer',$data);
  }
  
  public function update($slug){
    $event = Event::getObj($slug);
    
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $startTime = filter_input(INPUT_POST, "startTime", FILTER_SANITIZE_STRING);
    $endTime = filter_input(INPUT_POST, "endTime", FILTER_SANITIZE_STRING);
    $cost = filter_input(INPUT_POST, "cost", FILTER_SANITIZE_NUMBER_FLOAT);
    $maxAttendance = filter_input(INPUT_POST, "maxAttendance", FILTER_SANITIZE_NUMBER_INT);
    $location = filter_input(INPUT_POST, "location", FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
    
    $event->setName($name);
	  $event->setStartTime($startTime);
	  $event->setEndTime($endTime);
	  $event->setCost($cost);
	  $event->setMaxAttendance($maxAttendance);
	  $event->setLocation($location);
	  $event->setDescription($description);
    
    $event->save();
    
    Url::redirect("events/$slug");
    
  }
}
