var tvClass = new TV();

function TV() {

	this.init = () => {
	};

	this.getTV = (callback) => {

		const url = commandsFunctions.getResponsePageUrl();
		
		$.ajax({
			url: url+'&page=tv',
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

	el: '#tv',
	data: {
		movies: {}
	},

	ready() {
		this.getTV();
	},

	methods: {
		getTV() {

			tvClass.getTV((response) => {
				this.$set('movies', response);
			});
		}
	}
});
