function checkArray(newArray, entries, privateEntries) {
	var entryFound = false;

	for (var i = 0; i < newArray.length; i++) {
		if(!entryFound) {

			if(typeof entries[newArray[i].toLowerCase()] != 'undefined') {
				entryFound = true;
				makeAction(entries[newArray[i]]);
			}
		}
	}

	if(!entryFound) {
		for (var i = 0; i < newArray.length; i++) {
			if(!entryFound) {

				if(typeof privateEntries[newArray[i].toLowerCase()] != 'undefined') {
					entryFound = true;
					makeAction(privateEntries[newArray[i]]);
				}
			}
		}
	}
}

function sanitizeUserSaid(userSaid) {
	var newArray = [];

	for (var i = 0; i < userSaid.length; i++) {
		newArray.push(userSaid[i].toLowerCase().trim());
	}

	return newArray;
}

function makeAction(text) {
	// window.location.href = window.location.href+'/?text=temperature';

	$('iframe').remove();

	console.log(text);

	$.ajax({
		url: 'functions.php?text='+text,
		type: 'GET',

		success: function(response) {
			console.log(response);
			$('#main').append('<iframe style="opacity:0;" src="'+response+'"></iframe>');
		}
	});
}

function speakFromJavascript(text) {
	$('iframe').remove();
	$('#main').append(
		'<iframe style="opacity:0;" src="http://translate.google.com/translate_tts?tl=fr&client=tw-ob&q='+text+'"></iframe>'
	);
}

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

Object.size = function (obj) {
    var size = 0;
    for (var key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};

function in_array(needle, haystack) {

	var newArray = [];

	for (var i = 0; i < haystack.length; i++) newArray.push(haystack[i].toLowerCase().trim());

	if(haystack.indexOf(needle.toLowerCase().trim()) != -1) return true;

	return false;
}
