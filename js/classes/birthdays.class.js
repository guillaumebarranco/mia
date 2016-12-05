var birthdaysClass = new Birthdays();

function Birthdays() {

	this.init = () => {
	};

	this.getBirthdays = (callback) => {

		const url = commandsFunctions.getResponsePageUrl();
		
		$.ajax({
			url: url+'&page=birthdays',
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

	el: '#birthdays',
	data: {
		loader: true,
		birthdays: {}
	},

	ready() {
		this.getBirthdays();
	},

	methods: {
		getBirthdays() {

			birthdaysClass.getBirthdays((response) => {
				console.log(response);
				this.$set('loader', false);
				this.$set('birthdays', response);
			});
		}
	}
});
