var meteoClass = new Meteo();

function Meteo() {
	this.reloadWeather = 1; // In minutes

	this.init = () => {
	};

	this.getTemp = (callback) => {

		var source = 'js';

		var url = commandsFunctions.getResponseUrl('temperature_page', 'js');
		
		$.ajax({
			url: url,
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
	el: '#meteo',

	data: {
		temp: '',
		city: '',
		state: '',
		sunrise: '',
		sunset: ''
	},

	ready() {

		this.getWeather();

		setInterval(() => {
			this.getWeather();
		}, 1000*60*meteoClass.reloadWeather);
	},

	methods: {
		getWeather() {

			meteoClass.getTemp((response) => {

				let datas = response.text;

				let weather = datas.state.weather[0].main.toLowerCase();

				if(weather === "clouds" && datas.state.weather[0].description === "few clouds") {
					weather = "clear_few_clouds";
				}

				this.$set('temp', datas.temp);
				this.$set('city', datas.state.name);
				this.$set('state', `img/meteo/${weather}.png`);

				this.$set('sunrise', getHourFromTimestamp(datas.state.sys.sunrise));
				this.$set('sunset', getHourFromTimestamp(datas.state.sys.sunset));
			});
		}
	}
});

function getHourFromTimestamp(unix_timestamp) {

	var date = new Date(unix_timestamp*1000);
	var hours = getRealHour(date.getHours());
	var minutes = getRealHour(date.getMinutes());

	// Will display time in 10:30 format
	return hours + ':' + minutes;
}

function getRealHour(hour) {

	hour = parseInt(hour);

	if(hour < 10) hour = "0"+hour.toString();

	return hour;
}
