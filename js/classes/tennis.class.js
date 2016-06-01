var tennisClass = new tennis();

function tennis() {

	this.init = () => {
	};

	this.getFeed = (callback) => {

		const url = commandsFunctions.getResponsePageUrl();
		
		$.ajax({
			url: url+'&page=tennis&number=6',
			type: 'GET',
			success: function(response) {
				console.log(JSON.parse(response));
				response = JSON.parse(response);

				if(callback) callback(response);

			}, error: function() {
				myLoader.hide();
			}
		});	
	};
}

new Vue({

	el: '#tennis',
	data: {
		datas: {}
	},

	ready() {
		this.getFeed();
	},

	methods: {
		getFeed() {

			tennisClass.getFeed((response) => {
				this.$set('datas', response);
			});
		}
	}
});
