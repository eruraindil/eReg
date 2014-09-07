<?php
use \helpers\session as Session;
$menu = array();

if( Session::get('username') ) {
  $menu['Home'] = DIR;
  $menu['About Us'] = DIR . 'about';
  $menu['Help'] = array(
    'FAQ' => DIR . 'help/faq',
    'Contact' => DIR . 'help/contact'
  );
  $menu['Logout'] = DIR . 'logout';
}
?>

<?php /*
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>
    <div class="row">
      <div class="col-xs-5 col-xs-offset-3">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <?php foreach( $menu as $title => $url ):?>
              <li class=""><a href="<?php echo $url;?>"><?php echo $title;?></a></li>
            <?php endforeach;?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <?php if( ($username = \helpers\session::get('username'))):?>
            <p class="navbar-text pull-right">Signed in as <?php echo $username;?> | <a class="navbar-link" href="<?php echo DIR;?>logout">Logout</a></p>
          <?php else:
            <form class="navbar-form navbar-right" role="search">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
          <?php endif;?>
        </div><!-- /.navbar-collapse -->
      </div>
    </div>
  </div><!-- /.container-fluid -->
</nav>
*/?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <ul class="nav pull-right" id='main-nav'>
        <?php foreach( $menu as $title => $item ) {
          switch(gettype($item)) {
            case 'string':?>
              <li class=""><a href="<?php echo $item;?>"><?php echo $title;?></a></li>
              <?php break;
            case 'array':?>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <?php echo $title;?> <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                <?php foreach( $item as $title => $url ) {?>
                  <li class=""><a href="<?php echo $url;?>"><?php echo $title;?></a></li>
                <?php }?>
                </ul>
              </li>
              <?php break;
            default:
          }
        }?>
      </ul>
    </div>
  </div>
