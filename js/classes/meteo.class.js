function Meteo() {

	this.init = () => {
	};

	this.getTemp = () => {

		commandsFunctions.makeAction('temperature_page', 'js', function(response) {
			console.log(response);

			let datas = response.text;

			$('.temp').text(datas.temp);
		});
	};
}
