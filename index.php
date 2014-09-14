<?php
if(file_exists('vendor/autoload.php')){
	require 'vendor/autoload.php';
} else {
	echo "<h1>Please install via composer.json</h1>";
	echo "<p>Install Composer instructions: <a href='https://getcomposer.org/doc/00-intro.md#globally'>https://getcomposer.org/doc/00-intro.md#globally</a></p>";
	echo "<p>Once composer is installed navigate to the working directory in your terminal/command promt and enter 'composer install'</p>";
	exit;
}

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 *
 */
	define('ENVIRONMENT', 'development');
/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but production will hide them.
 */

if (defined('ENVIRONMENT')){

	switch (ENVIRONMENT){
		case 'development':
			error_reporting(E_ALL);
			ini_set("display_errors", 1);
		break;
  
		case 'production':
			error_reporting(0);
		break;

		default:
			exit('The application environment is not set correctly.');
	}

}

//create alias for Router
use \core\router as Router,
    \helpers\url as Url;

//define routes
Router::any( '', 			'\controllers\Welcome@index');
Router::get( 'about', 	'\controllers\Welcome@about');

/*
 *  articles GET    /articles(.:format)          articles#index
             POST   /articles(.:format)          articles#create
 new_article GET    /articles/new(.:format)      articles#new
edit_article GET    /articles/:id/edit(.:format) articles#edit
     article GET    /articles/:id(.:format)      articles#show
             PATCH  /articles/:id(.:format)      articles#update
             PUT    /articles/:id(.:format)      articles#update
             DELETE /articles/:id(.:format)      articles#destroy
 */

Router::get( 'events',              '\controllers\Events@index');
Router::post('events',              '\controllers\Events@create');
Router::get( 'events/new',          '\controllers\Events@make');
Router::get( 'events/(:num)/edit',  '\controllers\Events@edit');
Router::get( 'events/(:num)',       '\controllers\Events@show');
Router::post('events/(:num)',       '\controllers\Events@update');
Router::post('events/(:num)/remove','\controllers\Events@destroy');

Router::post('registrations',              '\controllers\Events@create');
Router::get( 'registrations/new/(:num)',   '\controllers\Events@make');
Router::get( 'registrations/(:num)/edit',  '\controllers\Events@edit');
Router::get( 'registrations/(:num)',       '\controllers\Events@show');
Router::post('registrations/(:num)',       '\controllers\Events@update');
Router::post('registrations/(:num)/remove','\controllers\Events@destroy');

Router::get( 'login',            	'\controllers\Auth@index');
Router::post('login',             '\controllers\Auth@login');
Router::any( 'logout',            '\controllers\Auth@logout');

//if no route found
Router::error('\core\error@index');

//execute matched routes
Router::dispatch();
