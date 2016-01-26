function checkArray(newArray, entries, privateEntries, source) {
	var entryFound = false;

	for (var i = 0; i < newArray.length; i++) {
		if(!entryFound) {

			if(typeof entries[newArray[i].toLowerCase()] != 'undefined') {
				entryFound = true;
				makeAction(entries[newArray[i]], source);
			}
		}
	}

	if(!entryFound) {
		for (var i = 0; i < newArray.length; i++) {
			if(!entryFound) {

				if(typeof privateEntries[newArray[i].toLowerCase()] != 'undefined') {
					entryFound = true;
					makeAction(privateEntries[newArray[i]], source);
				}
			}
		}
	}
}

// Main function
function searchCommand(newArray, source) {

	if(in_array('stop', newArray)) canReact = false;
	if(in_array('recharge', newArray)) location.reload();

	if(canReact) {

		if(in_array('combien de commandes possèdes-tu', newArray)) {
			speakFromJavascript('Je possède '+Object.size(entries)+' commandes et '+Object.size(privateEntries)+' commandes privées.');
		}

		checkArray(newArray, entries, privateEntries, source);

	} else {
		if(in_array('démarre', newArray)) canReact = true;
	}
}

function sanitizeUserSaid(userSaid) {
	var newArray = [];

	for (var i = 0; i < userSaid.length; i++) {
		newArray.push(userSaid[i].toLowerCase().trim());
	}

	return newArray;
}

function makeAction(text, source) {

	$('#main').empty();
	console.log(text);

	$.ajax({
		url: 'functions.php?text='+text+'&source=js',
		type: 'GET',

		success: function(response) {
			console.log(response);

			if(source === 'audio') {
				$('#main').append('<iframe style="opacity:0;" src="'+response+'"></iframe>');
			} else if(source === "writing") {
				$('#main').append('<h3>'+urldecode(response.substr(63))+'</h3>');
			}
			
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

function urldecode(str) {

  return decodeURIComponent((str + '')
    .replace(/%(?![\da-f]{2})/gi, function() {
      // PHP tolerates poorly formed escape sequences
      return '%25';
    })
    .replace(/\+/g, '%20'));
}
