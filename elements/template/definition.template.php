<div id="definitions">

	<div v-show="!loader" class="form">
		<input type="text" type="text" value="logique">
		<button class="update">Update</button>
	</div>

	<ul v-show="!loader" v-for="data in datas" class="definitions">
		<li>{{data}}</li>
	</ul>

	<i v-show="loader" style="font-size: 100px; text-align:center;" class="fa fa-spinner fa-spin"></i>
</div>

<?php
	$scripts = ["../node_modules/vue/dist/vue", "../node_modules/vue-resource/dist/vue-resource", "classes/definition.class"];
	loadScripts($scripts);
?>
