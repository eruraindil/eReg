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
    $events = new \models\Event();
    $data['event'] = $events->getEvent($slug);
    $data['title'] = $data['event'][0]['name'];
    
		View::rendertemplate('header',$data);
		View::rendertemplate('menu',$data);
		View::render('events/show',$data);
		View::rendertemplate('content-bottom',$data);
		View::rendertemplate('footer',$data);
  }
  
  public function edit($slug){
    if( !Session::get('username') ) {
			Url::redirect('login');
  	}
    $events = new \models\Event();
    $data['event'] = $events->getEvent($slug);
    $data['title'] = "Edit " . $data['event'][0]['name'];
    
    $data['js'] = "CKEDITOR.replace('editor1');";
    $data['exjs'] = "<script src='//cdn.ckeditor.com/4.4.4/basic/ckeditor.js'></script>";

		View::rendertemplate('header',$data);
		View::rendertemplate('menu',$data);
		View::render('events/edit',$data);
		View::rendertemplate('content-bottom',$data);
		View::rendertemplate('footer',$data);
  }
}

