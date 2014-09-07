	</div> <!-- //container-fluid -->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo \helpers\url::get_template_path();?>bootstrap/js/bootstrap.min.js"></script>

	<script>
	<?php echo $data['js']."\n";?>

	$(document).ready(function(){
		<?php echo $data['jq']."\n";?>
	});
	</script>
</body>
</html>
