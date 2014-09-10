<?php namespace controllers;
use core\view as View,
		\helpers\session as Session,
		\helpers\url as Url;

class Events extends \core\controller {
  public function __construct(){
		parent::__construct();
	}
  
  public function index(){
    $data['title'] = 'Events';

		View::rendertemplate('header',$data);
		View::rendertemplate('menu',$data);
		View::render('events/index',$data);
		View::rendertemplate('content-bottom',$data);
		View::rendertemplate('footer',$data);
  }
}

