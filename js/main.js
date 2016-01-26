$(document).ready(function() {

	var params = getSearchParameters();

	if(typeof params.text === 'undefined') {
		startListeningAudio();
	}

	$('form').on('submit', function(e) {
		e.preventDefault();

		var command = $('input').val().toLowerCase();
		$('input').val('');

		var newArray = [];
		newArray.push(command);

		searchCommand(newArray, 'writing');
	});

	// $('input').on('focusin', function() {
	// 	$(this).parent().find('label').addClass('active');
	// });

	// $('input').on('focusout', function() {
	// 	if (!this.value) {
	// 		$(this).parent().find('label').removeClass('active');
	// 	}
	// });

});
