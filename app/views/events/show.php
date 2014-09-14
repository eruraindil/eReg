<?php use helpers\session as Session;?>

<div class="row">
  <div class="col-md-10 col-md-offset-1 content">
    <h1><?php echo $data['title'];?></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo DIR;?>events">Events</a></li>
      <li class="active"><?php echo $data['event']->getName();?></li>
    </ol>
    <div class="row">
      <div class="col-md-7">
        <div class="panel panel-default">
          <div class="panel-body">
            <?php echo $data['event']->getDescription();?>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <table class="table table-bordered table-condensed">
          <tr>
            <?php if(
              \date("Y-m-d", strtotime($data['event']->getStartTime())) ==
              \date("Y-m-d", strtotime($data['event']->getEndTime()))
            ):?>
              <td colspan=2><strong>Date:</strong> <?php echo \date("Y-m-d", strtotime($data['event']->getStartTime()));?></td>
            <?php else:?>
              <td><strong>Start Date:</strong> <?php echo \date("Y-m-d", strtotime($data['event']->getStartTime()));?></td>
              <td><strong>End Date:</strong> <?php echo \date("Y-m-d", strtotime($data['event']->getEndTime()));?></td>
            <?php endif;?>
          </tr>
          <tr>
            <td><strong>Start Time:</strong> <?php echo \date("H:i", strtotime($data['event']->getStartTime()));?></td>
            <td><strong>End Time:</strong> <?php echo \date("H:i", strtotime($data['event']->getEndTime()));?></td>
          </tr>
          <tr>
            <td colspan=2><strong>Location:</strong> <?php echo $data['event']->getLocation();?></td>
          </tr>
          <tr>
            <td colspan=2>
              <strong>Attendance</strong>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $data['event']->getCurAttendance; ?>" aria-valuemin="0" aria-valuemax="<?php echo $data['event']->getMaxAttendance(); ?>" style="width: <?php echo (int)($data['event']->getCurAttendance() / $data['event']->getMaxAttendance() * 100); ?>%;">
                  <?php echo (int)($data['event']->getCurAttendance() / $data['event']->getMaxAttendance() * 100); ?>%
                </div>
              </div>
            </td>
          </tr>
        </table>
        <div class="btn-group">
          <a class="btn btn-primary btn-lg" href="<?php echo DIR . "events/" . $data['event']->getId();?>/register">Register</a>
          <?php if(Session::get("acl") == "admin"):?>
          <a href="<?php echo DIR . "events/" . $data['event']->getId();?>/edit" class="btn btn-warning btn-lg">Edit <span class="glyphicon glyphicon-edit"></span></a>
          <a href="" class="btn btn-danger btn-lg">Delete <span class="glyphicon glyphicon-remove"></span></a>
          <?php endif;?>
        </div>
      </div>
    </div>
    <?php if( Session::get("acl") == "admin"):?>
    <div class="row">
      <div class="col-md-12">
        <h2>Attendees</h2>
        <ul class="list-group" id="events-list">
          <?php foreach( $data['registrants'] as $registrant ):?>
          <li class="list-group-item"><a href="<?php echo DIR . "user/" . $registrant->getId();?>"><?php echo $registrant->getFirstName() . " " . $registrant->getLastName();?></a>
            <?php if( Session::get("acl") == "admin"):?>
            <div class="btn-group pull-right">
              <!--<a href="<?php echo DIR . "events/" . $event->getId();?>/edit" class="btn btn-xs btn-warning">Edit <span class="glyphicon glyphicon-edit"></span></a>-->
              <a href="" class="btn btn-xs btn-danger">Remove <span class="glyphicon glyphicon-remove"></span></a>
            </div>
            <?php endif;?>
          </li>
          <?php endforeach; ?>
        </ul>
        <?php if( count($data['registrants']) == 0 ):?>
        <p>No registrations</p>
        <?php endif;?>
      </div>
    </div>
    <?php endif;?>
  </div>
</div>