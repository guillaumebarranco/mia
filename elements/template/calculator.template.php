<div id="calculator">
	<form action="">
		<input type="text">
		<button>Valider</button>
	</form>

	<div>Result : {{result}}</div>
</div>

<?php
	$scripts = ["../node_modules/vue/dist/vue", "../node_modules/vue-resource/dist/vue-resource", "classes/calculator.class"];
	loadScripts($scripts);
?>
