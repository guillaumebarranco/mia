<!DOCTYPE>

<html lang="fr">
	<head>
		<title>Mia</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
		
		<link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/styles.css" />
		<link rel="stylesheet" href="css/mia.css" />
		<link rel="stylesheet" href="css/loader.css" />

		<?php require_once 'elements/header.php'; ?>
	</head>

	<body>

		<?php

			$template = 'index';
			if(isset($_GET['template'])) $template = $_GET['template'];

			require_once 'elements/nav.php';
		 	// require_once 'elements/mia_svg.php';
		 	require_once 'views/'.$template.'.template.php';
		 	
		 ?>

	</body>
</html>
