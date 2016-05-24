<div id="meteo">

	<h2 class="city">{{city}}</h2>
	<img v-bind:src="state" height="200" class="state" />
	<h2 class="temp">{{temp}}°C</h2>

	<div>
		Levé du soleil : {{sunrise}}
	</div>
	<div>
		Couché du soleil : {{sunset}}
	</div>

</div>

<?php
	$scripts = ["../node_modules/vue/dist/vue", "../node_modules/vue-resource/dist/vue-resource", "classes/meteo.class"];
	loadScripts($scripts);
?>

<script>

	// commandsFunctions.makeAction('temperature_page', 'js', (response) => {
		// 	console.log(response);

		// 	let datas = response.text;

		// 	this.$set('temp', datas.temp);
		// 	console.log(this.temp);
		// });

</script>
