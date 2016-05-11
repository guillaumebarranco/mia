<?php require_once('config.php'); ?>

<script>
	var JS_URL = "<?=JS_URL?>",
		MIA_URL = "<?=MIA_URL?>"
	;
</script>

<?php 
	$scripts = ["jquery", "annyang", "functions", "entries", "privateEntries", "audio", "main", "classes/meteo.class"];

	function loadScript($script) { echo '<script src="'.MIA_URL.'js/'.$script.'.js"></script>'; }
	
	foreach ($scripts as $script) loadScript($script);
?>
