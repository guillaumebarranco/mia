var twitterClass = new Twitter();

function Twitter() {

	this.init = () => {
	};

	this.getFeed = (callback) => {

		const url = commandsFunctions.getResponseUrl();
		
		$.ajax({
			url: url+'&page=twitter&type=username&search=Webarranco',
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

	el: '#twitter',
	data: {
		datas: {},
		name: ''
	},

	ready() {
		this.getFeed();
	},

	methods: {
		getFeed() {

			twitterClass.getFeed((response) => {
				this.$set('name', response.twitter.shift())
				this.$set('datas', response.twitter);
			});
		}
	}
});
