<?php require_once __DIR__.'/../config.php'; ?>

<script src="https://www.gstatic.com/firebasejs/live/3.0/firebase.js"></script>

<script>
	var JS_URL = "<?=JS_URL?>",
		MIA_URL = "<?=MIA_URL?>",
		AUDIO_ACTIVE = "<?=AUDIO_ACTIVE?>"
	;
</script>



<?php 
	$scripts = ["jquery", "annyang", "functions", "entries", "privateEntries", "database", "audio", "main", "streams"];

	function loadScript($script) { echo '<script src="'.MIA_URL.'js/'.$script.'.js"></script>'; }

	function loadScripts($scripts) {
		foreach ($scripts as $script) loadScript($script);
	}

	loadScripts($scripts);
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/annyang/2.5.0/annyang.js"></script>