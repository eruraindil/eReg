	</div> <!-- //container-fluid -->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo \helpers\url::template_path();?>bootstrap/js/bootstrap.min.js"></script>
  <?php echo $data['exjs']."\n";?>
  
	<script>
	<?php echo $data['js']."\n";?>

	$(document).ready(function(){
		<?php echo $data['jq']."\n";?>
	});
	</script>
</body>
</html>