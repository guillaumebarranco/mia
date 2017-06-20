var previouslySaid 				= [],
	previouslySaidPosition 		= -1,
	launchLoader 				= true,
	canReact 					= true,
	google_translate_length = 63
;

let commandsFunctions;

brainFunctions = new Brain();
mouthFunctions = new Mouth();
aiFunctions = new AI();
calculFunctions = new Calcul();

class echoCommand {	

	// From eventually GET Parameters, we check if the answer is made by audio or not
	getResponseUrl(text, source) {
		let url = MIA_URL;

		if(typeof getSearchParameters().overwrite !== 'undefined' /*|| source !== 'writing'*/) url = JS_URL;

		url += 'functions.php?text='+text+'&source=js';
		console.log(url);
		return url;
	};

	getResponsePageUrl() {
		let url = MIA_URL;

		if(typeof getSearchParameters().overwrite !== 'undefined' /*|| source !== 'writing'*/) url += JS_URL;

		url += 'functions.php?&source=js';
		return url;
	}

	// After the AJAX response, make Mia answer to what you said
	getMiaAnswer(responseText, source, cutText) {

		if(typeof cutText === 'undefined') var cutText = true;

		var google_translate_length = 63;

		$('iframe').remove();
		$('h3').empty();

		var subtext = (cutText) ? responseText.substr(google_translate_length) : responseText;

		if(source === "audio") {
			var time = getTimeTalkByText(subtext);
			mouthFunctions.speak(responseText, time);

		} else {
			var responseHtml = '<h3>'+urldecode(subtext)+'</h3>';
			$('#main').append(responseHtml);
		}
	}

	transformToText(audioText) {
		var subtext = audioText.substr(google_translate_length);
		return urldecode(subtext);
	}

	makeActionWithGetParams(text, source, params, callback) {

		$('#main').empty();
		console.log(text);

		var url = this.getResponseUrl(text, source);

		url += params;
		
		setTimeout(function() { if(launchLoader) myLoader.show(); }, 300);

		$.ajax({
			url: url,
			type: 'GET',
			success: (response) => {
				response = JSON.parse(response);
				console.log(response);

				myLoader.hide();
				if(!callback) this.getMiaAnswer(response.text, source);
				if(callback) callback(response);

			}, error: () => {
				myLoader.hide();
			}
		});
	}

	// Action sending params to mia core
	makeAction(text, source, callback) {

		$('#main').empty();
		console.log(text);

		var url = this.getResponseUrl(text, source);
		
		setTimeout(function() { if(launchLoader) myLoader.show(); }, 300);

		$.ajax({
			url: url,
			type: 'GET',
			success: (response) => {
				response = JSON.parse(response);
				console.log(response);

				myLoader.hide();
				if(!callback) this.getMiaAnswer(response.text, source);
				if(callback) callback(response);

			}, error: () => {
				myLoader.hide();
			}
		});
	}

	// Push the last said word in the previouslySaid tab to find it again with bottom/top arrows
	pushToPreviouslySaid(word) {
		previouslySaid.push(word);
		previouslySaidPosition++;
	}
}

commandsFunctions = new echoCommand();

class functionsForClean {

	// Converting and return the Object "entries" in Array (without modification to original "entries" var)
	formateEntries() {

		const formatedEntries = [];

		for (var entry in entries) {
			formatedEntries.push(entry);
		}

		return formatedEntries;
	}

	// Function for sanitize all entries (accents, trim, toLowerCase)
	sanitize(entry) {
		
		const pattern_accent 			= new Array("é", "è", "ê", "ë", "ç", "à", "â", "ä", "î", "ï", "ù", "ô", "ó", "ö", "-");
		const pattern_replace_accent 	= new Array("e", "e", "e", "e", "c", "a", "a", "a", "i", "i", "u", "o", "o", "o", " ");

		entry = entry.toLowerCase().trim();

		return preg_replace(pattern_accent, pattern_replace_accent, entry);
	}

	// Trim and all userSaid array
	sanitizeUserSaid(userSaid) {
		var newArray = [];
		for (var i = 0; i < userSaid.length; i++) newArray.push(this.sanitize(userSaid[i]));
		return newArray;
	}
}

cleanFunctions = new functionsForClean();

class Loader {

	show() {
		$('.loader').show();
	}

	hide() {

		launchLoader = false;
		$('.loader').hide();

		setTimeout(function() { launchLoader = true; }, 300);
	}
}

myLoader = new Loader();

/***********************/
/*   USEFUL FUNCTIONS  */
/***********************/

function getTimeTalkByText(text) {

	var time;

	if(text.length < 5) {
		time = 0.5;
	} else if(text.length >= 5 && text.length < 10) {
		time = 1;
	} else if(text.length >= 10 && text.length < 35) {
		time = 2;
	} else if(text.length >= 35 && text.length < 60) {
		time = 3;
	} else if(text.length >= 60 && text.length < 85) {
		time = 4;
	} else {
		time = 5;
	}

	return time;
}

// Return all GET parameters of the URL
function getSearchParameters() {
	var prmstr = window.location.search.substr(1);
	return prmstr !== null && prmstr !== "" ? transformToAssocArray(prmstr) : {};
}

function transformToAssocArray(prmstr) {
    var params = {},
    	prmarr = prmstr.split("&");

    for ( var i = 0; i < prmarr.length; i++) {
        var tmparr = prmarr[i].split("=");
        params[tmparr[0]] = tmparr[1];
    }

    return params;
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

// Search for a variable in an array
function in_array(needle, haystack) {

	var newArray = [];
	for (var i = 0; i < haystack.length; i++) newArray.push(haystack[i].toLowerCase().trim());

	if(haystack.indexOf(needle.toLowerCase().trim()) != -1) return true;
	return false;
}

function strpos (haystack, needle, offset) {
  //  discuss at: http://locutus.io/php/strpos/
  // original by: Kevin van Zonneveld (http://kvz.io)
  // improved by: Onno Marsman (https://twitter.com/onnomarsman)
  // improved by: Brett Zamir (http://brett-zamir.me)
  // bugfixed by: Daniel Esteban
  //   example 1: strpos('Kevin van Zonneveld', 'e', 5)
  //   returns 1: 14
  var i = (haystack + '')
    .indexOf(needle, (offset || 0))
  return i === -1 ? false : i
}

// Copy of urldecode native function of PHP
function urldecode(str) {

  return decodeURIComponent((str + '')
    .replace(/%(?![\da-f]{2})/gi, function() {
      return '%25';
    })
    .replace(/\+/g, '%20'));
}

// Return length of an object
Object.size = function (obj) {
    var size = 0;
    for (var key in obj) if (obj.hasOwnProperty(key)) size++;
    return size;
};

function isNotUndefined(wth) {
    if (wth !== undefined && typeof wth !== 'undefined') return true;
}

/****************/
/*   LISTENERS  */
/****************/

// Listening top arrow on keyboard to search previous command said
$('input').on('keydown', function(e) {
	// console.log(e.which);

	if(e.which === 38) {
		$('input').val(previouslySaid[previouslySaidPosition]);
		if(previouslySaidPosition > 0) previouslySaidPosition--;

	} else if(e.which === 40) {
		$('input').val(previouslySaid[previouslySaidPosition]);
		if(previouslySaidPosition <= previouslySaid.length) previouslySaidPosition++;
	}
});
