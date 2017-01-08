var recipesClass = new Recipes();

function Recipes() {

	this.init = () => {
	};

	this.getrecipes = (callback) => {

		const url = commandsFunctions.getResponsePageUrl();
		
		$.ajax({
			url: url+'&page=recipes',
			type: 'GET',
			success: function(response) {
				response = JSON.parse(response);
				console.log(response);

				if(callback) callback(response);

			}, error: function() {
				myLoader.hide();
			}
		});	
	};
}

new Vue({

	el: '#recipes',
	data: {
		loader: true,
		recipes: {},
		currentRecipe: {}
	},

	ready() {
		this.getRecipes();
	},

	methods: {
		getRecipes() {

			recipesClass.getrecipes((response) => {
				console.log(response);
				this.$set('loader', false);
				this.$set('recipes', response);
			});
		},

		updateCurrentRecipe(datas) {
			this.$set('currentRecipe', datas);
			console.log('currentRecipe', datas);
		}
	}
});
