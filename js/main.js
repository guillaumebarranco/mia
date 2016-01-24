function getSearchParameters() {
      var prmstr = window.location.search.substr(1);
      return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
}

function transformToAssocArray( prmstr ) {
    var params = {};
    var prmarr = prmstr.split("&");
    for ( var i = 0; i < prmarr.length; i++) {
        var tmparr = prmarr[i].split("=");
        params[tmparr[0]] = tmparr[1];
    }
    return params;
}

var params = getSearchParameters();

function makeAction(text) {
	// window.location.href = window.location.href+'/?text=temperature';

	$('iframe').remove();

	$.ajax({
		url: 'functions.php?text='+text,
		type: 'GET',

		success: function(response) {
			console.log(response);
			$('#main').append('<iframe style="opacity:0;" src="'+response+'"></iframe>')
		}
	});
}

$(document).ready(function() {

	if(typeof params.text === 'undefined') {
		startListeningAudio();

		setTimeout(function() {
			// window.location.href = window.location.href;
		}, 10000);
	}
});
