<!DOCTYPE>

<html lang="fr">
	<head>
		<title>Mia</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
		
		<link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="media/css/styles.css" />
		<link rel="stylesheet" href="media/css/mia.css" />
		<link rel="stylesheet" href="media/css/loader.css" />
		<link rel="stylesheet" href="media/css/nav.css" />
		<link rel="stylesheet" href="media/css/font-awesome.css" />

		<!-- <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png"> -->
		<!-- <link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png"> -->
		<link rel="icon" type="image/png" sizes="32x32" href="favicon/logo.png">
		<!-- <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png"> -->
		<!-- <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png"> -->
		<!-- <link rel="manifest" href="/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff"> -->

		<?php require_once 'elements/header.php'; ?>
	</head>

	<body>

		<?php

			$template = 'index';
			if(isset($_GET['template'])) $template = $_GET['template'];

			require_once 'elements/nav.php';

		 	if($template === 'index') require_once 'elements/mia_svg.php';

		 	require_once 'elements/template/'.$template.'.template.php';		 	
		 ?>

	</body>
</html>
