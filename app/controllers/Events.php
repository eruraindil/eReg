<?php namespace controllers;
use \core\view as View,
		\helpers\session as Session,
		\helpers\url as Url;

class Events extends \core\controller {
  public function __construct(){
		parent::__construct();
	}
  
  public function index(){
    $data['title'] = 'Events';
    
    $events = new \models\Event();
    $data['events'] = $events->getEventsAll();

		View::rendertemplate('header',$data);
		View::rendertemplate('menu',$data);
		View::render('events/index',$data);
		View::rendertemplate('content-bottom',$data);
		View::rendertemplate('footer',$data);
  }
  
  public function show($slug){
    $data['title'] = 'Events';
    
    $events = new \models\Event();
    $data['event'] = $events->getEvent($slug);

		View::rendertemplate('header',$data);
		View::rendertemplate('menu',$data);
		View::render('events/show',$data);
		View::rendertemplate('content-bottom',$data);
		View::rendertemplate('footer',$data);
  }
}

