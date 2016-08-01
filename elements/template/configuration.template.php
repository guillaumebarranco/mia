<div class="wrapper">

	<ul>
		<li class="btn btn-config active" data-show="maison">
			Maison
		</li>

		<li class="btn btn-config" data-show="config">
			Configuration
		</li>	
	</ul>

	<div class="section_tab section_maison">

		<div>Maison</div>

		<h2>Lumière</h2>
		<div>Etat : {{lum.state}}</div>

	</div>

	<div class="section_tab section_config">

		<ul>
			<li>
				Prévenir si la batterie est inférieure à 20%
				<div>
					<button class="btn active">Oui</button>
					<button class="btn">Non</button>
				</div>
			</li>
		</ul>
	</div>

	<?php
		$scripts = ["../node_modules/vue/dist/vue", "../node_modules/vue-resource/dist/vue-resource", "classes/maison.class"];
		loadScripts($scripts);
	?>

</div>