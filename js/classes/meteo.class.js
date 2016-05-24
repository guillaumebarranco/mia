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
		temp: '',
		city: '',
		state: ''
	},

	// Anything within the ready function will run when the application loads
	ready() {

		meteoClass.getTemp((response) => {

			let datas = response.text;

			let weather = datas.state.weather[0].main.toLowerCase();

			if(weather === "clouds" && datas.state.weather[0].description === "few clouds") {
				weather = "clear_few_clouds";
			}

			this.$set('temp', datas.temp);
			this.$set('city', datas.state.name);
			this.$set('state', `img/meteo/${weather}.png`);
		});
	},

	// Methods we want to use in our application are registered here
	methods: {}
});
