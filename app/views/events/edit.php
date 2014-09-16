<?php 
use helpers\form as Form;
$event = $data['event'];

echo Form::open(array("action" => DIR . "events/" . $event->getId()));?>
<div class="row">
  <div class="col-md-10 col-md-offset-1 content">
    <h1><?php echo $data['title'];?></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo DIR;?>events">Events</a></li>
      <li><a href="<?php echo DIR . "events/" . $event->getId();?>"><?php echo $event->getName();?></a></li>
      <li class="active">Edit</li>
    </ol>
    <div class="row">
      <div class="col-md-7">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" value="<?php echo $data['event']->getName();?>">
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea name="description" id="description" rows="15" cols="80">
            <?php echo $event->getDescription();?>
          </textarea>
        </div>
      </div>
      <div class="col-md-5">
        <table class="table table-bordered table-condensed">
          <tr>
            <td>
              <div class="form-group">
                <label for="startTime">Start Date</label>
                <input type="datetime" class="form-control" id="startTime" name="startTime" value="<?php echo \date("Y-m-d H:i", strtotime($event->getStartTime()));?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <label for="endTime">End Date</label>
                <input type="datetime" class="form-control" id="endTime" name="endTime" value="<?php echo \date("Y-m-d H:i", strtotime($event->getEndTime()));?>">
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <div class="form-group">
                <label for="startDate">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="<?php echo $event->getLocation(); ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="form-group">
                <label for="maxAttendance">Attendance</label>
                <div class="input-group">
                  <span class="input-group-addon">
                    <?php echo $event->getCurAttendance(); ?> / 
                  </span>
                  <input type="number" class="form-control" id="maxAttendance" name="maxAttendance" value="<?php echo $event->getMaxAttendance(); ?>">
                </div>
              </div>
            </td>
            <td>
              <div class="form-group">
                <label for="cost">Cost</label>
                <div class="input-group">
                  <span class="input-group-addon">
                    $ 
                  </span>
                  <input type="number" step="any" class="form-control" id="cost" name="cost" value="<?php echo $event->getCost(); ?>">
                </div>
              </div>
            </td>
          </tr>
        </table>
        <?php echo Form::submit(
          array(
            "value"=>"Save",
            "class"=>"btn-lg",
            "cancel"=>DIR . "events/" . $event->getId())
        );?>
      </div>
    </div>
  </div>
</div>
<?php echo Form::close();?>
