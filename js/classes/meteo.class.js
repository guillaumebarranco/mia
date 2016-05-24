var meteoClass = new Meteo();

function Meteo() {

	this.init = () => {
	};

	this.getTemp = (callback) => {


		commandsFunctions.makeAction('temperature_page', 'js', (response) => {
			console.log(response);

			if(callback) callback(response);
		});
		
	};
}

new Vue({

	// We want to target the div with an id of 'meteo'
	el: '#meteo',

	// Here we can register any values or collections that hold data
	// for the application
	data: {
		temp: ''
	},

	// Anything within the ready function will run when the application loads
	ready() {

		meteoClass.getTemp((response) => {

			let datas = response.text;

			this.$set('temp', datas.temp);
		});	
	},

	// Methods we want to use in our application are registered here
	methods: {}
});