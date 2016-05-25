var meteoClass = new Meteo();

function Meteo() {
	this.reloadWeather = 1; // In minutes

	this.init = () => {
	};

	this.getTemp = (callback) => {

		var source = 'js';

		var url = commandsFunctions.getResponsePageUrl();
		
		$.ajax({
			url: url+'&page=temperature_page',
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
		current: {
			temp: '',
			city: '',
			state: '',
			sunrise: '',
			sunset: '',
			day: '',
			timestamp: ''
		},

		forecast: [
			{
				temp: 0,
				city: '',
				state: '',
				hour: ''
			},
			{
				temp: 0,
				state: '',
				hour: ''
			}
		]
	},

	ready() {

		this.getWeather();

		// setInterval(() => {
		// 	this.getWeather();
		// }, 1000*60*meteoClass.reloadWeather);
	},

	methods: {
		getWeather() {

			meteoClass.getTemp((response) => {

				let datas = response;

				let weather = datas.today.weather[0].main.toLowerCase();

				if(weather === "clouds" && datas.today.weather[0].description === "few clouds") {
					weather = "clear_few_clouds";
				}

				this.current.temp = Math.round(datas.today.main.temp);
				this.current.city = datas.today.name;
				this.current.state = `img/meteo/${weather}.png`;

				this.current.sunrise = getHourFromTimestamp(datas.today.sys.sunrise);
				this.current.sunset = getHourFromTimestamp(datas.today.sys.sunset);
				this.current.day = datas.day;
				this.current.timestamp = datas.hour;

				this.getWeathers(response);
			});
		},

		getWeathers(response) {

			console.log('getWeathers', response);

			let i = 0,
				datas = response
			;

			for(var element in datas.forecast.list) {

				let data = datas.forecast.list[element],
					weather = data.weather[0].main.toLowerCase()
				;

				if(data.dt > this.current.timestamp) {

					if(weather === "clouds" && data.weather[0].description === "few clouds") {
						weather = "clear_few_clouds";
					}

					this.forecast[i].temp =  Math.round(data.main.temp);
					this.forecast[i].state =  `img/meteo/${weather}.png`;
					this.forecast[i].hour = getHourFromTimestamp(data.dt);

					i++;

					if(i === 2) break;
				}
			}
		}
	}
});

function getHourFromTimestamp(unix_timestamp) {

	var date = new Date(unix_timestamp*1000),
		hours = getRealHour(date.getHours()),
		minutes = getRealHour(date.getMinutes())
	;

	// Will display time in 10:30 format
	return hours + ':' + minutes;
}

function getRealHour(hour) {

	hour = parseInt(hour);

	if(hour < 10) hour = "0"+hour.toString();

	return hour;
}
