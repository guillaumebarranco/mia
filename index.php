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
	</head>

	<body>

		<nav>
			<a href="#" data-link="meteo">Meteo</a>
			<a href="#" data-link="home">Home</a>
		</nav>

		<?php require_once('mia_svg.php'); ?>

		<div class="wrap" style="margin-top: 150px;">

			<form action="" autocomplete="off">

				<div>
					<label class="active" for="fname">Type your command</label>
					<input id="fname" type="text" class="cool" autofocus/>
				</div>

				<button style="opacity:0;" class="sendCommand">Send Command</button>

			</form>

			<article class="loader">
                <div class="rectangle-bounce selected">
                  <div class="rect1"></div>
                  <div class="rect2"></div>
                  <div class="rect3"></div>
                  <div class="rect4"></div>
                  <div class="rect5"></div>
                </div>
            </article>

			<section id="main"></section>

		</div>

		<?php require_once('footer.php'); ?>

	</body>
</html>
