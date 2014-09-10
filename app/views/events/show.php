<?php use helpers\session as Session;?>

<div class="row">
  <div class="col-md-10 col-md-offset-1 content">
    <h1><?php echo $data['title'];?></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo DIR;?>events">Events</a></li>
      <li class="active"><?php echo $data['event'][0]['name'];?></li>
    </ol>
    <div class="row">
      <div class="col-md-7">
        <div class="panel panel-default">
          <div class="panel-body">
            <?php echo $data['event'][0]['description'];?>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <table class="table table-bordered table-condensed">
          <tr>
            <?php if(
              \date("Y-m-d", strtotime($data['event'][0]['startTime'])) ==
              \date("Y-m-d", strtotime($data['event'][0]['endTime']))
            ):?>
              <td colspan=2><strong>Date:</strong> <?php echo \date("Y-m-d", strtotime($data['event'][0]['startTime']));?></td>
            <?php else:?>
              <td><strong>Start Date:</strong> <?php echo \date("Y-m-d", strtotime($data['event'][0]['startTime']));?></td>
              <td><strong>End Date:</strong> <?php echo \date("Y-m-d", strtotime($data['event'][0]['endTime']));?></td>
            <?php endif;?>
          </tr>
          <tr>
            <td><strong>Start Time:</strong> <?php echo \date("H:i", strtotime($data['event'][0]['startTime']));?></td>
            <td><strong>End Time:</strong> <?php echo \date("H:i", strtotime($data['event'][0]['endTime']));?></td>
          </tr>
          <tr>
            <td colspan=2>
              <strong>Attendance</strong>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $data['event'][0]['curAttendance']; ?>" aria-valuemin="0" aria-valuemax="<?php echo $data['event'][0]['maxAttendance']; ?>" style="width: <?php echo (int)($data['event'][0]['curAttendance'] / $data['event'][0]['maxAttendance'] * 100); ?>%;">
                  <?php echo (int)($data['event'][0]['curAttendance'] / $data['event'][0]['maxAttendance'] * 100); ?>%
                </div>
              </div>
            </td>
          </tr>
          <?php /*<tr>
            <td colspan=2></td>
          </tr>*/?>
        </table>
        <a class="btn btn-primary btn-block btn-lg" href="<?php echo DIR . "events/" . $data['event'][0]['id'];?>/register">Register</a>
        <div class="btn-group">
          <a href="<?php echo DIR . "events/" . $data['event'][0]['id'];?>/edit" class="btn btn-warning">Edit <span class="glyphicon glyphicon-edit"></span></a>
          <a href="" class="btn btn-danger">Delete <span class="glyphicon glyphicon-remove"></span></a>
        </div>
      </div>
    </div>
    <?php if( Session::get("acl") == "admin"):?>
    <div class="row">
      <div class="col-md-12">
        
      </div>
    </div>
    <?php endif;?>
  </div>
</div>