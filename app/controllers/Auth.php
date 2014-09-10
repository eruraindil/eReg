<?php namespace controllers;
use \core\view as View,
    \helpers\session as Session,
    \helpers\password as Password,
    \helpers\url as Url;

class Auth extends \core\controller {

  public function __construct() {
    parent::__construct();
  }

  public function index() {
    $data['title'] = SITETITLE . ' Login';
    $data['jq'] = "\$('.row').slideDown(900, function(){\$('#username').focus();});";

    View::rendertemplate('header',$data);
    View::rendertemplate('menu',$data);
    View::render('login', $data);
    View::rendertemplate('footer',$data);
  }

  public function login() {
    $users = new \models\User();
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $user = $users->getUser($username);
    // $hash = Password::make($_POST['password']);

    // echo "<pre>" . print_r($user[0],1) . "</pre>";
    // echo "<pre>" . print_r($hash,1) . "</pre>";

    if( $user[0]['username'] ) {
       if( Password::verify($password, $user[0]['password']) ) { //authenticated
        Session::set('username',$username);
        Session::set('acl',$user[0]['acl']);
        Url::redirect('');
      } else {
        $data['title'] = SITETITLE . " Login";
        $data['warning'] = "bad password, please try again";
        $data['username'] = $username;
        $data['jq'] = "\$('.row').slideDown(900, function(){\$('#password').focus();});";
      }
    } else {
      $data['title'] = SITETITLE . " Login";
      $data['error'] = "bad email, please try again";
      $data['username'] = $username;
      $data['jq'] = "\$('.row').slideDown(900, function(){\$('#username').select();});";
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
