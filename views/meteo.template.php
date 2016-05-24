<h1>Test</h1>

<div id="meteo">
	
	<h2 class="temp" v-html="temp"></h2>

</div>

<?php
	$scripts = ["../node_modules/vue/dist/vue", "../node_modules/vue-resource/dist/vue-resource", "classes/meteo.class"];
	loadScripts($scripts);
?>

<script>

	meteoClass.getTemp();

	// commandsFunctions.makeAction('temperature_page', 'js', (response) => {
		// 	console.log(response);

		// 	let datas = response.text;

		// 	this.$set('temp', datas.temp);
		// 	console.log(this.temp);
		// });

</script>
