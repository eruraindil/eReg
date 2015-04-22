<!DOCTYPE html>
<html lang="<?php echo LANGUAGE_CODE; ?>">
<head>

	<!-- Site meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo (isset($data['title']) ? $data['title'].' - '.SITETITLE : SITETITLE); //SITETITLE defined in index.php?></title>

	<!-- Bootstrap -->
	<link href="<?php echo \helpers\url::template_path();?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo \helpers\url::template_path();?>css/style.css" rel="stylesheet">
  <link href="//fonts.googleapis.com/css?family=Poiret+One|Open+Sans" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<title><?php echo $data['title'].' - '.SITETITLE; //SITETITLE defined in app/core/config.php ?></title>

	<!-- CSS -->
	<?php
		helpers\assets::css(array(
			'//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css',
			helpers\url::template_path() . 'css/style.css',
		))
	?>
</head>

<body>
<div class="container-fluid">