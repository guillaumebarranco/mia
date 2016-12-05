var tennisClass = new tennis();

function tennis() {

	this.init = () => {
		this.initFunctions();
	};

	this.getFeed = (callback) => {

		const url = commandsFunctions.getResponsePageUrl();

		console.log(url);

		console.log($('input[name=number]').val());
		
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

$(document).on('click', '.fiche', function() {
	$(this).parent().find('.popup').removeClass('hidden');
});

$(document).on('click', '.close', function() {
	$('.popup').addClass('hidden');
});

new Vue({

	el: '#tennis',
	data: {
		loader: true,
		datas: {}
	},

	ready() {

		var that = this;

		$('.update').on('click', function() {
			that.$set('loader', true);
			that.getFeed();
		});

		this.getFeed();
	},

	methods: {
		getFeed() {

			tennisClass.getFeed((response) => {
				this.$set('loader', false);
				$('.popup').hide();
				this.$set('datas', response);
			});
		}
	}
});
