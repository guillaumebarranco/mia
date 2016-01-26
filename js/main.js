$(document).ready(function() {

	var params = getSearchParameters();

	if(typeof params.text === 'undefined') {
		//startListeningAudio();
	}

	$('.sendCommand').on('click', function() {
		var command = $('input').val();
		$('input').val('');

		var newArray = [];
		newArray.push(command);

		searchCommand(newArray, 'writing');
	});
});
