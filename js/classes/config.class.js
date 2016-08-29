var maisonClass = new Maison();
maisonClass.init();

function Maison() {

	this.init = () => {
		this.initFunctions();
	};

	this.getConfiguration = (callback) => {

		const url = commandsFunctions.getResponsePageUrl();
		
		$.ajax({
			url: url+'&page=config',
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

		$('.section_config').hide();

		$('.btn-config').on('click', function() {

			$('.btn-config').removeClass('active');

			$(this).addClass('active');

			$('.section_tab').hide();

			if($(this).data('show') === 'config') {
				$('.section_config').show();

			} else if($(this).data('show') === 'maison') {
				$('.section_maison').show();
			}
		});
	};
}

new Vue({

	el: '.section_maison',
	data: {
		lum: {
			state: 0
		},
		raspberry: {
			status: 0
		}
	},

	ready() {
		this.getConfiguration();
	},

	methods: {
		getConfiguration() {

			maisonClass.getConfiguration((response) => {
				// this.$set('name', response.news.shift())
				this.$set('lum', response.lum);
				this.$set('raspberry', response.raspberry);
			});
		}
	}
});
