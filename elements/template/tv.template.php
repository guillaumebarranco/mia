<div id="tv">

	<div v-show="!loader" v-for="movie in movies">

		<div class="station"><strong>{{movie.title}}</strong></div>

		<div src class="picture">
			<img src="{{movie.picture}}" alt="">
		</div>

		<div class="movie">{{movie.movie}}</div>
		<div class="hour">{{movie.hour}}</div>
	</div>

	<i v-show="loader" style="font-size: 100px; text-align:center;" class="fa fa-spinner fa-spin"></i>
</div>

<?php
	$scripts = ["../node_modules/vue/dist/vue", "../node_modules/vue-resource/dist/vue-resource", "classes/tv.class"];
	loadScripts($scripts);
?>
