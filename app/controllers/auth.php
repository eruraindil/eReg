<?php namespace controllers;
use core\view as View,
    \helpers\session as Session,
    \helpers\url as Url;

class Auth extends \core\controller {

  public function __construct() {
    parent::__construct();
  }

  public function index() {
    $data['title'] = 'Login';
    $data['jq'] = "$('.row').slideDown(900);";

    View::rendertemplate('header',$data);
    View::rendertemplate('menu',$data);
    View::render('login', $data);
    View::rendertemplate('footer',$data);
  }

  public function login() {
    $users = new \models\users();
    $user = $users->getUser($_POST['username']);
    // $hash = \helpers\password::make($_POST['password']);

    // echo "<pre>" . print_r($user[0],1) . "</pre>";
    // echo "<pre>" . print_r($hash,1) . "</pre>";

    if( $user[0]['username'] ) {
       if( \helpers\password::verify($_POST['password'], $user[0]['password']) ) { //authenticated
        Session::set('username',$_POST['username']);
        Url::redirect('');
      } else {
        $data['title'] = "Login";
        $data['warning'] = "bad password, please try again";
        $data['username'] = $_POST['username'];
        $data['jq'] = "$('.row').slideDown(900);";
      }
    } else {
      $data['title'] = "Login";
      $data['error'] = "bad email, please try again";
      $data['jq'] = "$('.row').slideDown(900);";
    }
    View::rendertemplate('header',$data);
    View::rendertemplate('menu',$data);
    View::render('login',$data);
    View::rendertemplate('footer',$data);
  }

  public function logout() {
    Session::pull('username');
    Url::redirect('');
  }
}
