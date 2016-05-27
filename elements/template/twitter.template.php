<div id="twitter">

	<h2>{{name}}</h2>

	<div v-for="data in datas">
		<div>{{data.text}}</div>
	</div>

</div>

<?php
	$scripts = ["../node_modules/vue/dist/vue", "../node_modules/vue-resource/dist/vue-resource", "classes/twitter.class"];
	loadScripts($scripts);
?>
