var definitionsClass = new Definitions();

function Definitions() {

	this.init = () => {
	};

	this.getDefinitions = (callback) => {

		const url = commandsFunctions.getResponsePageUrl();
		
		$.ajax({
			url: url+'&page=definition&definition='+$('input').val(),
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

	el: '#definitions',
	data: {
		loader: true,
		datas: {}
	},

	ready() {
		this.getDefinitions();

		var that = this;

		$('.update').on('click', function() {
			that.$set('loader', true);
			that.getDefinitions();
		});
	},

	methods: {
		getDefinitions() {

			definitionsClass.getDefinitions((response) => {
				console.log(response);
				this.$set('loader', false);
				this.$set('datas', response);
			});
		}
	}
});
