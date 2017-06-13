<div v-show="!loader" class="form">
	<input type="text" name="number" type="number" value="10">
	<button class="update">Update</button>
</div>

<div id="tennis">
		
	<div v-show="!loader" v-for="data in datas" class="tennis">

		<div class="fiche">

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

		<div class="popup hidden">

			<div class="head">
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

			<div class="saisons">
				
				<div class="currentSaison">
					<h4>Cette année</h4>
					<div class="nbTitles">{{data.popup.currentSaison.nbVictories}}</div>
					<div class="ratio">{{data.popup.currentSaison.ratio}}</div>

					<ul class="victoriesTitles">
						<li v-for="victory in data.popup.currentSaison.victories">
							{{victory}}
						</li>
					</ul>
				</div>

				<div class="lastSaison">
					<h4>L'année dernière</h4>
					<div class="nbTitles">{{data.popup.lastSaison.nbVictories}}</div>
					<div class="ratio">{{data.popup.lastSaison.ratio}}</div>

					<ul class="victoriesTitles">
						<li v-for="victory in data.popup.lastSaison.victories">
							{{victory}}
						</li>
					</ul>
				</div>
			</div>

			<div class="close">X</div>

		</div>
	</div>

	<i v-show="loader" style="font-size: 100px; text-align:center;" class="fa fa-spinner fa-spin"></i>
</div>

<?php
	$scripts = ["../node_modules/vue/dist/vue", "../node_modules/vue-resource/dist/vue-resource", "classes/tennis.class"];
	loadScripts($scripts);
?>
