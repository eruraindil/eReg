<?php namespace core;
/*
 * model - the base model
 *
 * @author David Carr - dave@daveismyname.com - http://www.daveismyname.com
 * @version 2.1
 * @date June 27, 2014
 */

use Illuminate\Database\Capsule\Manager as Capsule;

class Model extends Controller {

	/**
	 * hold the database connection
	 * @var object
	 */
	//protected $_db;

	/**
	 * create a new instance of the database helper
	 */
	public function __construct(){
		//connect to PDO here.
		//$this->_db = new \helpers\database();
		$capsule = new Capsule;

		$capsule->addConnection([
		    'driver'    => 'mysql',
		    'host'      => 'localhost',
		    'database'  => 'ereg',
		    'username'  => 'ereg',
		    'password'  => 'smvc',
		    'charset'   => 'utf8',
		    'collation' => 'utf8_unicode_ci',
		    'prefix'    => '',
		]);

		// Set the event dispatcher used by Eloquent models... (optional)
		//use Illuminate\Events\Dispatcher;
		//use Illuminate\Container\Container;
		//$capsule->setEventDispatcher(new Dispatcher(new Container));

		// Set the cache manager instance used by connections... (optional)
		//$capsule->setCacheManager(...);

		// Make this Capsule instance available globally via static methods... (optional)
		$capsule->setAsGlobal();

		// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
		$capsule->bootEloquent();
	}
}
