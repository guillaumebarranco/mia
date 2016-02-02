<!DOCTYPE>

<html lang="fr">
	<head>
		<title>Mia</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
		
		<link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/styles.css" />
		<link rel="stylesheet" href="css/mia.css" />
	</head>

	<body>

		<?php require_once('mia_svg.php'); ?>

		<div class="wrap" style="margin-top: 150px;">

			<form action="" autocomplete="off">

				<div>
					<label class="active" for="fname">Type your command</label>
					<input id="fname" type="text" class="cool" autofocus/>
				</div>

				<button style="opacity:0;" class="sendCommand">Send Command</button>
				
			</form>

			<section id="main"></section>

		</div>

		<?php 
			$scripts = ["jquery", "annyang", "functions", "entries", "privateEntries", "audio", "main"];

			function loadScript($script) { echo '<script src="js/'.$script.'.js"></script>'; }
			
			foreach ($scripts as $script) loadScript($script);
		?>

	</body>
</html>
