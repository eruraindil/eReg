<?php namespace controllers;
use \core\view as View,
		\helpers\session as Session,
		\helpers\url as Url;

class Welcome extends \core\controller{

	/**
	 * call the parent construct
	 */
	public function __construct(){
		parent::__construct();
	}

	/**
	 * define page title and load template files
	 */
	public function index(){
		//$data['title'] = 'Welcome';
    
    $data = array();

		View::rendertemplate('header',$data);
		View::rendertemplate('menu',$data);
		View::render('index',$data);
		View::rendertemplate('content-bottom',$data);
		View::rendertemplate('footer',$data);
	}

	public function about(){
		$data['title'] = 'About';

		View::rendertemplate('header',$data);
		View::rendertemplate('menu',$data);
		View::render('about',$data);
		View::rendertemplate('content-bottom',$data);
		View::rendertemplate('footer',$data);
	}

}
