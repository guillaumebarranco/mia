var tvClass = new TV();

function TV() {

	this.init = () => {
	};

	this.getTV = (callback) => {

		const source = 'js',
			url = commandsFunctions.getResponseUrl('tv_page', 'js')
		;
		
		$.ajax({
			url: url,
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
				this.$set('movies', response.text);
			});
		}
	}
});
