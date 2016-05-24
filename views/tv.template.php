<div id="tv">

	<div v-for="movie in movies">

		<div class="station"><strong>{{movie.title}}</strong></div>

		<div src class="picture">
			<img src="{{movie.picture}}" alt="">
		</div>

		<div class="movie">{{movie.movie}}</div>
		<div class="hour">{{movie.hour}}</div>
	</div>

</div>

<?php
	$scripts = ["../node_modules/vue/dist/vue", "../node_modules/vue-resource/dist/vue-resource", "classes/tv.class"];
	loadScripts($scripts);
?>
