<div id="tennis">

	<div v-for="data in datas" class="tennis">

		<h3><strong>{{data.ranking}}</strong></h3>
		<h3 class="name">{{data.name}}</h3>

		<div class="picture">
			<img v-bind:src="data.picture" alt="">
		</div>

		<div>
			<div>{{data.country}}</div>
			<div>{{data.points}}</div>
		</div>
	</div>

</div>

<?php
	$scripts = ["../node_modules/vue/dist/vue", "../node_modules/vue-resource/dist/vue-resource", "classes/tennis.class"];
	loadScripts($scripts);
?>
