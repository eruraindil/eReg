<?php namespace core;

/*
 * config - an example for setting up system settings
 * When you are done editing, rename this file to 'config.php'
 *
 * @author David Carr - dave@daveismyname.com - http://www.daveismyname.com
 * @author Edwin Hoksberg - info@edwinhoksberg.nl
 * @version 2.1
 * @date June 27, 2014
 */
class Config {

	public function __construct() {

		//turn on output buffering
		ob_start();

		//site address
		define('DIR','http://home.mroberts.me/eReg/');
		
		//set default controller and method for legacy calls
		define('DEFAULT_CONTROLLER', 'welcome');
		define('DEFAULT_METHOD'    , 'index');
    
    //database details ONLY NEEDED IF USING A DATABASE
		define('DB_TYPE','mysql');
		define('DB_HOST','racetrack.home.mroberts.me');
		define('DB_NAME','ereg');
		define('DB_USER','ereg');
		define('DB_PASS','smvc');
		define('PREFIX','');

		//set prefix for sessions
		define('SESSION_PREFIX', 'smvc_');

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
		\helpers\session::set('template','eReg');
    
	}

}
