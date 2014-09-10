<?php namespace core;
/*
 * config - setup system wide settings
 *
 * @author David Carr - dave@daveismyname.com - http://www.daveismyname.com
 * @version 2.1
 * @date June 27, 2014
 */
class Config {

	public function __construct(){

		//turn on output buffering
		ob_start();

		//site address
		define('DIR','http://home.mroberts.me/eReg/');
		
		//set default controller and method for legacy calls
		define('DEFAULT_CONTROLLER', 'welcome');
		define('DEFAULT_METHOD'    , 'index');

		//set prefix for sessions
		define('SESSION_PREFIX','smvc_');

		//optional create a constant for the name of the site
		define('SITETITLE','eREG');
    
    //optional email associated with the site maintainer who should get messages
    define('ADMINEMAIL','matt@stikmen.ca');
    
		//turn on custom error handling
		set_exception_handler('core\logger::exception_handler');
		set_error_handler('core\logger::error_handler');
		
		//set timezone
		date_default_timezone_set('America/Regina');
    
		//start sessions
		\helpers\session::init();

		//set the default template
		\helpers\session::set('template','default');

	}

}
