<?php use helpers\session as Session;?>

<div class="row">
  <div class="col-md-10 col-md-offset-1 content">
    <h1><?php echo $data['title'];?></h1>
    <hr />
    <ul class="list-group" id="events-list">
      <?php foreach($data['events'] as $event):?>
      <li class="list-group-item"><a href="<?php echo DIR . "events/" . $event->getId();?>"><?php echo $event->getName();?></a>
        <?php if( Session::get('username') ):?>
        <div class="btn-group pull-right">
          <a href="<?php echo DIR . "events/" . $event->getId() . "/edit";?>" class="btn btn-xs btn-warning">Edit <span class="glyphicon glyphicon-edit"></span></a>
          <a href="" class="btn btn-xs btn-danger">Delete <span class="glyphicon glyphicon-remove"></span></a>
        </div>
        <?php endif;?>
      </li>
      <?php endforeach; ?>
    </ul>
    <?php
    $start = new \DateTime("First day of this month", new \DateTimeZone("America/Regina"));
    $en;
    ?>
    <!--
    <h2><?php echo $start->format("F") . " " . $start->format("Y");?></h2>
    <table class="table table-condensed" id="calendar">
      <thead>
        <tr>
          <th>Sunday</th>
          <th>Monday</th>
          <th>Tuesday</th>
          <th>Wednesday</th>
          <th>Thursday</th>
          <th>Friday</th>
          <th>Saturday</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php for($i=1;$i<=$start->format("t") + $start->format("w");$i++):?>
          <td>
            <?php $day = $i - $start->format("w");
            if($day > 0):?>
            <div class="panel panel-default">
              <div class="panel-heading"><?php echo $day;?></div>
              <div class="panel-body">
              <?php foreach($data['events'] as $event) {
                if($day === (int) \date("j",strtotime($event->getStartTime()))):?>
                  <span class="label label-primary"><?php echo $event->getName();?></span>
                <?php endif;
              }?>
              </div>
            </div>
            <?php endif;?>
          </td>
          <?php if(($i)%7==0):?>
        </tr>
        <tr>
          <?php endif;?>
          <?php endfor;?>
          <?php $end = $start->format("t") + $start->format("w"); while($end%7!=0):?>
          <td></td>
          <?php $end = $end+1; endwhile;?>
        </tr>
      </tbody>
    </table>-->
    
    <div class="row">
      <?php for($i=0;$i<7;$i++):/*
      <div class="col-md-<?php echo ( $i == 0 || $i == 6 ? 1 : 2);?>">
        <div class="panel panel-default">
          <div class="panel-heading"><?php echo $i;?></div>
          <div class="panel-body"></div>
        </div>
      </div>
      <?php*/ endfor;?>
    </div>
  </div>
</div>
