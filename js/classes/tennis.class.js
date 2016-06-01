var tennisClass = new tennis();

function tennis() {

	this.init = () => {
		this.initFunctions();
	};

	this.getFeed = (callback) => {

		const url = commandsFunctions.getResponsePageUrl();
		
		$.ajax({
			url: url+'&page=tennis&number='+$('input[name=number]').val(),
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

	this.initFunctions = () => {
	};
}

new Vue({

	el: '#tennis',
	data: {
		datas: {}
	},

	ready() {

		var that = this;

		$('.update').on('click', function() {
			that.getFeed();
		});

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
