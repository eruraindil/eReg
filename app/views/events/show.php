<?php use helpers\session as Session;
$event = $data['event'];
?>

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
            <?php if($event->isOneDay()):?>
              <td colspan="2"><strong>Date:</strong> <?php echo \date("Y-m-d", strtotime($event->getStartTime()));?></td>
            <?php else:?>
              <td><strong>Start Date:</strong> <?php echo \date("Y-m-d", strtotime($event->getStartTime()));?></td>
              <td><strong>End Date:</strong> <?php echo \date("Y-m-d", strtotime($event->getEndTime()));?></td>
            <?php endif;?>
          </tr>
          <tr>
            <td><strong>Start Time:</strong> <?php echo \date("H:i", strtotime($event->getStartTime()));?></td>
            <td><strong>End Time:</strong> <?php echo \date("H:i", strtotime($event->getEndTime()));?></td>
          </tr>
          <tr>
            <td colspan="2"><strong>Cost:</strong> $<?php echo $event->getCost();?></td>
          </tr>
          <tr>
            <td colspan="2"><strong>Location:</strong> <?php echo $event->getLocation();?></td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Attendance</strong>
              <div class="progress">
                <?php $percent = (int)($event->getCurAttendance() / $event->getMaxAttendance() * 100);?>
                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $event->getCurAttendance; ?>" aria-valuemin="0" aria-valuemax="<?php echo $event->getMaxAttendance(); ?>" style="width: <?php echo $percent;?>%;">
                  <?php echo $percent > 5 ? $percent . "%</div>" : "</div>" . $percent . "%" ; ?>
              </div>
            </td>
          </tr>
        </table>
        <div class="btn-group">
          <?php if(!$event->isFull()):?>
          <a class="btn btn-primary btn-lg" href="<?php echo DIR . "registrations/new/" . $data['event']->getId();?>">Register</a>
          <?php else:?>
          <button class="btn btn-primary btn-lg disabled">Full</button>
          <?php endif;?>
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
          <?php foreach( $data['registrations'] as $registration ):?>
          <li class="list-group-item"><a href="<?php echo DIR . "registrations/" . $registration->getId();?>"><?php echo $registration->getFirstName() . " " . $registration->getLastName();?></a>
            <?php if( Session::get("acl") == "admin"):?>
            <div class="btn-group pull-right">
              <a href="<?php echo DIR . "registrations/" . $registration->getId() . "/remove";?>" class="btn btn-xs btn-danger">Remove <span class="glyphicon glyphicon-remove"></span></a>
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