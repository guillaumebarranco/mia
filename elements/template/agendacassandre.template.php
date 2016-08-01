<style>
	#agenda section {
		margin-top: 10px;
	}
	#agenda section div {
		display: inline-block;
		vertical-align: top;
		margin-left: 5px;
	}
</style>

<div id="agenda" class="wrapper">

	<!-- <section>
		<div>L</div> <div>M</div> <div>M</div> <div>J</div> <div>V</div> <div>S</div> <div>D</div>
	</section>

	<section>
		<div>C</div> <div>C</div> <div>R</div> <div>R</div> <div>S</div> <div>S</div> <div>S</div>
	</section>

	<section>
		<div>S</div> <div>R</div> <div>C</div> <div>M</div> <div>M</div> <div>M</div> <div>R</div>
	</section>

	<section>
		<div>R</div> <div>S</div> <div>S</div> <div>S</div> <div>C</div> <div>C</div> <div>R</div>
	</section>

	<section>
		<div>R</div> <div>S</div> <div>S</div> <div>C</div> <div>S</div> <div>R</div> <div>R</div>
	</section>

	<section>
		<div>R</div> <div>M</div> <div>M</div>
	</section> -->

	<div class="agenda">

		<div class="elem_day" v-for="day in days">
			{{day}}
		</div>

		<br>
		
		<div v-for="data in agenda" track-by="$index" class="elem">

			<div class="{{data.active}}">
				<div>{{data.number}}</div>
				<div><span class="hour_section">{{data.section}}</span></div>
			</div>
		</div>
	</div>

</div>

<?php
	$scripts = ["../node_modules/vue/dist/vue", "../node_modules/vue-resource/dist/vue-resource", "classes/agenda.class"];
	loadScripts($scripts);
?>
