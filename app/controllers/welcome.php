<?php namespace controllers;
use core\view as View,
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

		if( !Session::get('username') ) {
			Url::redirect('login');
		}
		//$data['title'] = 'Welcome';

		View::rendertemplate('header',$data);
		View::rendertemplate('menu',$data);
		View::render('welcome/welcome',$data);
		View::rendertemplate('content-bottom',$data);
		View::rendertemplate('footer',$data);
	}

	public function about(){
		$data['title'] = 'About';

		View::rendertemplate('header',$data);
		View::rendertemplate('menu',$data);
		View::render('welcome/about',$data);
		View::rendertemplate('footer',$data);
	}

}
