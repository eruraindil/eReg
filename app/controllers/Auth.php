<?php namespace controllers;
use core\view as View,
    helpers\session as Session,
    helpers\password as Password,
    helpers\url as Url;

class Auth extends \core\controller {

  public function __construct() {
    parent::__construct();
  }

  public function index() {
    if( Session::get('username') ) {
			Url::redirect("");
  	}
    
    $data['title'] = SITETITLE . " Login";
    $data['jq'] = "\$('.row').slideDown(900, function(){\$('#username').focus();});";
    $data['goto'] = filter_input(INPUT_SERVER, 'HTTP_REFERER', FILTER_SANITIZE_URL);

    View::rendertemplate("header",$data);
    //View::rendertemplate("menu",$data);
    View::render("login", $data);
    View::rendertemplate("footer",$data);
  }

  public function login() {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    $goto = filter_input(INPUT_POST, "goto", FILTER_SANITIZE_URL);
    
    $user = \models\User::getObjByUsername($username);
    
    echo "<pre>" . print_r($user,1) . "</pre>";
    // $hash = Password::make($_POST['password']);

    // echo "<pre>" . print_r($user[0],1) . "</pre>";
    // echo "<pre>" . print_r($hash,1) . "</pre>";

    if( $user ) {
       if( Password::verify($password, $user->getPassword()) ) { //authenticated
        Session::set("username",$username);
        Session::set("acl",$user->getAcl());
        
        if( $goto == "" || $goto == DIR . "login" ) {
          Url::redirect("");
        } else {
          header("Location: $goto");
        }
      } else {
        $data['warning'] = "bad password, please try again";
        $data['jq'] = "\$('.row').slideDown(900, function(){\$('#password').focus();});";
      }
    } else {
      $data['error'] = "bad email, please try again";
      $data['jq'] = "\$('.row').slideDown(900, function(){\$('#username').select();});";
    }
    $data['title'] = SITETITLE . " Login";
    $data['username'] = $username;
    
    View::rendertemplate("header",$data);
    //View::rendertemplate("menu",$data);
    View::render("login",$data);
    View::rendertemplate("footer",$data);
  }

  public function logout() {
    Session::pull("username");
    Session::pull("acl");
    
    $goto = filter_input(INPUT_SERVER, "HTTP_REFERER", FILTER_SANITIZE_URL);
    if($goto == "") {
      Url::redirect("");
    } else {
      header("Location: $goto");
    }
  }
}
