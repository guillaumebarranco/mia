$(document).ready(function() {

	var params = getSearchParameters();

	if(typeof params.text === 'undefined') startListeningAudio();

	$('form#mainForm').on('submit', function(e) {
		e.preventDefault();

		var command = $('input[type=text]').val().toLowerCase();
		$('input[type=text]').val('');

		brainFunctions.searchCommand([command], 'writing');
	});

	$('.hamburger').on('click', function() {
		let menu = $(this).parent().find('.menu');

		if(menu.is(':hidden')) {
			menu.show();
		} else {
			menu.hide();
		}
	});

	if(AUDIO_ACTIVE) {
		$('.toggleMicro').addClass('active');
	}

	$('.toggleMicro').on('click', function() {
		AUDIO_ACTIVE = !AUDIO_ACTIVE;

		$('.toggleMicro').toggleClass('active');
	})
});
