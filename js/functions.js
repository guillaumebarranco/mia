var previouslySaid = '';

// Search for entries in userSaid

function checkArray(userSaid, entries, privateEntries, source) {
	var entryFound = false;

	for (var i = 0; i < userSaid.length; i++) {
		if(!entryFound) {

			if(typeof entries[sanitize(userSaid[i])] != 'undefined') {
				entryFound = true;
				previouslySaid = userSaid[i];
				makeAction(entries[userSaid[i]], source);
			}
		}
	}

	if(!entryFound) {
		for (var i = 0; i < userSaid.length; i++) {
			if(!entryFound) {

				if(typeof privateEntries[sanitize(userSaid[i])] != 'undefined') {
					entryFound = true;
					previouslySaid = userSaid[i];
					makeAction(privateEntries[userSaid[i]], source);
				}
			}
		}
	}
}

// Main function
function searchCommand(newArray, source) {

	if(in_array('stop', newArray)) canReact = false;
	if(in_array('recharge', newArray)) location.reload();
	if(in_array('répète', newArray)) {

		if(previouslySaid !== '') {
			checkArray([previouslySaid], entries, privateEntries, source);
		}
	}

	if(canReact) {

		if(in_array('combien de commandes possèdes-tu', newArray)) {
			speakFromJavascript('Je possède '+Object.size(entries)+' commandes et '+Object.size(privateEntries)+' commandes privées.');
		}

		checkArray(newArray, entries, privateEntries, source);

	} else {
		if(in_array('démarre', newArray)) canReact = true;
	}
}

// Trim and all userSaid array
function sanitizeUserSaid(userSaid) {
	var newArray = [];

	for (var i = 0; i < userSaid.length; i++) {
		newArray.push(sanitize(userSaid[i]));
	}

	return newArray;
}

// Action sending params to mia core
function makeAction(text, source) {

	$('#main').empty();
	console.log(text);

	var google_translate_length = 63,
		url;

	if(typeof getSearchParameters()['overwrite'] !== 'undefined') {

		url = JS_URL+'functions.php?text='+text+'&source=js';

	} else {

		if(source === 'writing') {
			url = 'functions.php?text='+text+'&source=js';
		} else {
			url = JS_URL+'functions.php?text='+text+'&source=js';
		}
	}

	$.ajax({
		url: url,
		type: 'GET',

		success: function(response) {
			console.log(response);

			if(source === 'audio') {
				$('#main').append('<iframe style="opacity:0;" src="'+response+'"></iframe>');
			} else if(source === "writing") {
				$('#main').append('<h3>'+urldecode(response.substr(google_translate_length))+'</h3>');
			}

			$('#mouth').addClass('anim');

			setTimeout(function() {
				$('#mouth').removeClass('anim');
			}, 2000);
			
		}
	});
}

$('input').on('keydown', function(e) {
	if(e.which === 38) {
		$('input').val(previouslySaid);
	}
});

// If action is made purely in Javascript
function speakFromJavascript(text) {
	$('iframe').remove();
	$('#main').append(
		'<iframe style="opacity:0;" src="http://translate.google.com/translate_tts?tl=fr&client=tw-ob&q='+text+'"></iframe>'
	);
}

// Return all GET parameters of the URL
function getSearchParameters() {
      var prmstr = window.location.search.substr(1);
      return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
}

function transformToAssocArray(prmstr) {
    var params = {};
    var prmarr = prmstr.split("&");
    for ( var i = 0; i < prmarr.length; i++) {
        var tmparr = prmarr[i].split("=");
        params[tmparr[0]] = tmparr[1];
    }
    return params;
}

// Function for sanitize all entries (accents, trim, toLowerCase)
function sanitize(entry) {

	var pattern_accent = new Array("é", "è", "ê", "ë", "ç", "à", "â", "ä", "î", "ï", "ù", "ô", "ó", "ö");
	var pattern_replace_accent = new Array("e", "e", "e", "e", "c", "a", "a", "a", "i", "i", "u", "o", "o", "o");

	entry = entry.toLowerCase().trim();

	return entry;

	//return preg_replace(pattern_accent, pattern_replace_accent, entry);
}

function preg_replace (array_pattern, array_pattern_replace, my_string)  {
	var new_string = String (my_string);
		for (i=0; i<array_pattern.length; i++) {
			var reg_exp= RegExp(array_pattern[i], "gi");
			var val_to_replace = array_pattern_replace[i];
			new_string = new_string.replace (reg_exp, val_to_replace);
		}
	return new_string;
}




// Return length of an object
Object.size = function (obj) {
    var size = 0;
    for (var key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};

// Search for a variable in an array
function in_array(needle, haystack) {

	var newArray = [];

	for (var i = 0; i < haystack.length; i++) newArray.push(haystack[i].toLowerCase().trim());

	if(haystack.indexOf(needle.toLowerCase().trim()) != -1) return true;

	return false;
}

// Copy of urldecode native function of PHP
function urldecode(str) {

  return decodeURIComponent((str + '')
    .replace(/%(?![\da-f]{2})/gi, function() {
      // PHP tolerates poorly formed escape sequences
      return '%25';
    })
    .replace(/\+/g, '%20'));
}
