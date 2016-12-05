<div id="birthdays">
	
	<div v-show="!loader" v-for="b in birthdays">
		{{b.date}} - {{b.name}}
	</div>

	<i v-show="loader" style="font-size: 100px; text-align:center;" class="fa fa-spinner fa-spin"></i>
</div>

<?php
	$scripts = ["../node_modules/vue/dist/vue", "../node_modules/vue-resource/dist/vue-resource", "classes/birthdays.class"];
	loadScripts($scripts);
?>
