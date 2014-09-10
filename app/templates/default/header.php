<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo (isset($data['title']) ? $data['title'].' - '.SITETITLE : SITETITLE); //SITETITLE defined in index.php?></title>

	<!-- Bootstrap -->
	<link href="<?php echo \helpers\url::get_template_path();?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo \helpers\url::get_template_path();?>css/style.css" rel="stylesheet">
  <link href="//fonts.googleapis.com/css?family=Poiret+One|Open+Sans" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
