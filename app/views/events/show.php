<div class="row">
  <div class="col-md-10 col-md-offset-1 content">
    <h1><?php echo $data['event'][0]['name'];?></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo DIR;?>/events">Events</a></li>
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
                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $data['event'][0]['curAttendance']; ?>" aria-valuemin="0" aria-valuemax="<?php echo $data['event'][0]['maxAttendance']; ?>" style="width: <?php echo $data['event'][0]['curAttendance']; ?>%;">
                  <?php echo $data['event'][0]['curAttendance']; ?>%
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan=2></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>