$(document).ready(function() {

	var params = getSearchParameters();

	if(typeof params.text === 'undefined') {
		startListeningAudio();
	}
});
