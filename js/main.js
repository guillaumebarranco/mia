$(document).ready(function() {

	var params = getSearchParameters();

	if(typeof params.text === 'undefined') startListeningAudio();

	$('form').on('submit', function(e) {
		e.preventDefault();
		
		var command = $('input').val().toLowerCase();
		$('input').val('');

		commandsFunctions.searchCommand([command], 'writing');
	});

	$('nav a').on('click', function(e) {
		e.preventDefault();

		var link = $(this).data('link');

		if(link === "meteo") {
			var meteoClass = new Meteo();
			meteoClass.init();
		}
	});

	$('.hamburger').on('click', function() {
		let menu = $(this).parent().find('.menu');

		if(menu.is(':hidden')) {
			menu.show();
		} else {
			menu.hide();
		}
	});
});
