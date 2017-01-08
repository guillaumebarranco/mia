<button>Ajouter une recette</button>

<div id="recipes">


	<ul v-show="!loader" v-for="r in recipes" class="recipes">
		
		<li v-on:click="updateCurrentRecipe(r)">{{r.name}}</li>
	</ul>

	<div v-show="!loader && currentRecipe.name" class="currentRecipe" style="padding-bottom: 50px;">
		
		<h2>{{currentRecipe.name}}</h2>

		<div v-for="(index, value) in currentRecipe.metadata">
			<div v-if="index === 'preparation'">Preparation : {{value}}</div>
			<div v-if="index === 'cuisson'">Cuisson : {{value}}</div>
			<div v-if="index === 'persons'">Persons : {{value}}</div>
		</div>
		
		<h4>Ingrédients</h4>
		<ul v-for="i in currentRecipe.ingredients">
			<li>{{i}}</li>
		</ul>
	
		<h4>Recette</h4>
		<ul v-for="(index, r) in currentRecipe.recipe">
			<li>{{index+1}}. {{r}}</li>
		</ul>
	</div>

	<i v-show="loader" style="font-size: 100px; text-align:center;" class="fa fa-spinner fa-spin"></i>
</div>

<?php
	$scripts = ["../node_modules/vue/dist/vue", "../node_modules/vue-resource/dist/vue-resource", "classes/recipes.class"];
	loadScripts($scripts);
?>