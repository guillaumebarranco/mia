var newsClass = new News();

function News() {

	this.init = () => {
	};

	this.getFeed = (callback) => {

		const url = commandsFunctions.getResponsePageUrl();
		
		$.ajax({
			url: url+'&page=news',
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

	el: '#news',
	data: {
		datas: {},
		name: ''
	},

	ready() {
		this.getFeed();
	},

	methods: {
		getFeed() {

			newsClass.getFeed((response) => {
				this.$set('name', response.news.shift())
				this.$set('datas', response.news);
			});
		}
	}
});
