<?php use helpers\session as Session;?>

<div class="row">
  <div class="col-md-10 col-md-offset-1 content">
    <h1><?php echo $data['title'];?></h1>
    <hr />
    <ul class="list-group" id="events-list">
      <?php foreach($data['events'] as $event):?>
      <li class="list-group-item"><a href="<?php echo DIR . "events/" . $event['id'];?>"><?php echo $event['name'];?></a>
        <?php if( Session::get('username') ):?>
        <div class="btn-group pull-right">
          <a href="<?php echo DIR . "events/" . $event['id'];?>/edit" class="btn btn-xs btn-warning">Edit <span class="glyphicon glyphicon-edit"></span></a>
          <a href="" class="btn btn-xs btn-danger">Delete <span class="glyphicon glyphicon-remove"></span></a>
        </div>
        <?php endif;?>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
