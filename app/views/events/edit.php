<div class="row">
  <div class="col-md-10 col-md-offset-1 content">
    <h1><?php echo $data['title'];?></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo DIR;?>events">Events</a></li>
      <li><a href="<?php echo DIR . "events/" . $data['event'][0]['id'];?>"><?php echo $data['event'][0]['name'];?></a></li>
      <li class="active">Edit</li>
    </ol>
    <div class="row"><form method="post" target="<?php echo DIR . "events/" . $data['event'][0]['id'];?>">
      <div class="col-md-7">
        <textarea name="description" id="description" rows="10" cols="80">
          <?php echo $data['event'][0]['description'];?>
        </textarea>
      </div>
      <div class="col-md-5">
        <table class="table table-bordered table-condensed">
          <tr>
            <td>
              <div class="form-group">
                <label for="startTime">Start Date</label>
                <input type="datetime" class="form-control" id="startTime" name="startTime" value="<?php echo \date("Y-m-d H:i", strtotime($data['event'][0]['startTime']));?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <label for="endTime">End Date</label>
                <input type="datetime" class="form-control" id="endTime" name="endTime" value="<?php echo \date("Y-m-d H:i", strtotime($data['event'][0]['endTime']));?>">
              </div>
            </td>
          </tr>
          <tr>
            <td colspan=2>
              <div class="form-group">
                <label for="startDate">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="<?php echo $data['event'][0]['location']; ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td colspan=2>
              <div class="form-group">
                <label for="startDate">Attendance</label>
                <div class="input-group col-xs-3">
                  <span class="input-group-addon">
                    <?php echo $data['event'][0]['curAttendance']; ?> / 
                  </span>
                  <input type="number" class="form-control" id="maxAttendance" name="maxAttendance" value="<?php echo $data['event'][0]['maxAttendance']; ?>">
                </div>
              </div>
            </td>
          </tr>
        </table>
        <div class="btn-group">
          <input type="submit" class="btn btn-primary btn-lg" value="Save" />
          <a class="btn btn-default btn-lg" href="<?php echo DIR . "events/" . $data['event'][0]['id'];?>">Cancel</a>
        </div>
      </div>
    </form></div>
  </div>
</div>