<div id="meteo">

	<div class="day">{{current.day}}</div>

	<div class="meteo">

		<div>
			Levé du soleil : {{current.sunrise}}
		</div>
		<div>
			Couché du soleil : {{current.sunset}}
		</div>
	</div>
	

	<div class="meteo">

		<h2 class="hour">{{current.hour}}</h2>
		<h2 class="city">{{current.city}}</h2>
		<img v-bind:src="current.state" height="200" class="state" />
		<h2 class="temp">{{current.temp}}°C</h2>

	</div>

	<hr>

	<div class="meteo" v-for="data in forecast">
		
		<h2 class="hour">{{data.hour}}</h2>
		<h2 class="city">{{data.city}}</h2>
		<img v-bind:src="data.state" height="200" class="state" />
		<h2 class="temp">{{data.temp}}°C</h2>
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
