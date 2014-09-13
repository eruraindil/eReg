<div class="row" style="display:none;">
  <div class="col-sm-4 col-sm-offset-4 text-center">
    <h1><?php echo $data['title'];?></h1>
    <?php if( isset($data['error']) ):?>
      <div class="alert alert-danger">
        <?php echo $data['error'];?>
      </div>
    <?php endif;?>

    <?php if( isset($data['warning']) ):?>
      <div class="alert alert-warning">
        <?php echo $data['warning'];?>
      </div>
    <?php endif;?>

    <form role="form" method="post">
      <div class="form-group form-group-lg<?php echo ( isset($data['error']) ? ' has-error': '');?>">
        <input type="email" name="username" id="username" placeholder="email" class="form-control" <?php echo ( isset($data['username']) ? 'value="' . $data['username'] . '"' : '');?>>
      </div>
      <div class="form-group form-group-lg<?php echo ( isset($data['warning']) ? ' has-warning': '');?>">
        <input type="password" name="password" id="password" placeholder="password" class="form-control">
      </div>
      <input type="submit" class="btn btn-primary btn-lg btn-block" value="login">
      <input type="hidden" name="goto" value="<?php echo $data['goto'];?>">
    </form>
  </div>
</div>
