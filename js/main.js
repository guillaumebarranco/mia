$(document).ready(function() {

	var params = getSearchParameters();

	if(typeof params.text === 'undefined') startListeningAudio();

	$('form').on('submit', function(e) {
		e.preventDefault();
		
		var command = $('input').val().toLowerCase();
		$('input').val('');

		commandsFunctions.searchCommand([command], 'writing');
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
