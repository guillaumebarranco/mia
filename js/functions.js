var previouslySaid = [],
	previouslySaidPosition = -1,
	commandsFunctions = new echoCommand(),
	cleanFunctions = new functionsForClean(),
	morphingFunctions = new functionsForMorphing(),
	myLoader = new Loader(),
	launchLoader = true
;

function echoCommand() {

	var _this = this;

	// Main function
	this.searchCommand = function(newArray, source) {

		if(in_array('stop', newArray)) canReact = false;
		if(in_array('recharge', newArray)) location.reload();

		if(in_array('répète', newArray)) {
			if(previouslySaid[0] !== '') _this.checkArray(previouslySaid, entries, privateEntries, source);
		}

		if(canReact) {

			if(in_array('combien de commandes possèdes-tu', newArray)) {
				_this.speakFromJavascript('Je possède '+Object.size(entries)+' commandes et '+Object.size(privateEntries)+' commandes privées.');
			}

			_this.checkArray(newArray, entries, privateEntries, source);

		} else {
			if(in_array('démarre', newArray)) canReact = true;
		}
	};

	// Search for entries in userSaid
	this.checkArray = function(userSaid, entries, privateEntries, source) {
		var entryFound = false;

		for (var i = 0; i < userSaid.length; i++) {
			if(!entryFound) {

				if(typeof entries[cleanFunctions.sanitize(userSaid[i])] != 'undefined') {
					entryFound = true;
					commandsFunctions.pushToPreviouslySaid(userSaid[i]);
					_this.makeAction(entries[userSaid[i]], source);
				}
			}
		}

		if(!entryFound) {
			for (var j = 0; j < userSaid.length; j++) {
				if(!entryFound) {

					if(typeof privateEntries[cleanFunctions.sanitize(userSaid[j])] != 'undefined') {
						entryFound = true;
						commandsFunctions.pushToPreviouslySaid(userSaid[i]);
						_this.makeAction(privateEntries[userSaid[j]], source);
					}
				}
			}
		}

		if(!entryFound) morphingFunctions.checkForSimilateAnswer(userSaid, cleanFunctions.formateEntries(), 1, source);
	};

	// Action sending params to mia core
	this.makeAction = function(text, source) {

		$('#main').empty();
		console.log(text);

		var google_translate_length = 63,
			url;

		if(typeof getSearchParameters().overwrite !== 'undefined') {

			url = JS_URL+'functions.php?text='+text+'&source=js';

		} else if(typeof getSearchParameters().local !== 'undefined') {
			url = 'functions.php?text='+text+'&source=js';
		} else {

			if(source === 'writing') {
				url = 'functions.php?text='+text+'&source=js';
			} else {
				url = JS_URL+'functions.php?text='+text+'&source=js';
			}
		}

		if(typeof getSearchParameters().audio !== 'undefined' && getSearchParameters().audio == 'true') {
			source = "audio";
		}

		
		setTimeout(function() {
			if(launchLoader) myLoader.show();
		}, 300);

		$.ajax({
			url: url,
			type: 'GET',

			success: function(response) {
				response = JSON.parse(response);
				console.log(response);

				launchLoader = false;

				myLoader.hide();

				setTimeout(function() {
					launchLoader = true;
				}, 300);

				var subtext = response.text.substr(google_translate_length),
					time = getTimeTalkByText(subtext);

				if(source === 'audio') {
					$('#main').append('<iframe style="opacity:0;" src="'+response.text+'"></iframe>');
				} else if(source === "writing") {
					$('#main').append('<h3>'+urldecode(subtext)+'</h3>');
				}

				$('#mouth').addClass('anim');

				setTimeout(function() {
					$('#mouth').removeClass('anim');
				}, time * 1000);
			}
		});
	};

	// If action is made purely in Javascript
	this.speakFromJavascript = function(text) {
		$('iframe').remove();
		$('#main').append(
			'<iframe style="opacity:0;" src="http://translate.google.com/translate_tts?tl=fr&client=tw-ob&q='+text+'"></iframe>'
		);
	};

	this.pushToPreviouslySaid = function(word) {
		previouslySaid.push(word);
		previouslySaidPosition++;
	};
}

function functionsForClean() {

	var _this = this;

	this.formateEntries = function() {
		var formatedEntries = [];
		for (var entry in entries) formatedEntries.push(entry);
		return formatedEntries;
	};

	// Function for sanitize all entries (accents, trim, toLowerCase)
	this.sanitize = function(entry) {

		var pattern_accent = new Array("é", "è", "ê", "ë", "ç", "à", "â", "ä", "î", "ï", "ù", "ô", "ó", "ö");
		var pattern_replace_accent = new Array("e", "e", "e", "e", "c", "a", "a", "a", "i", "i", "u", "o", "o", "o");

		entry = entry.toLowerCase().trim();

		return entry;

		//return preg_replace(pattern_accent, pattern_replace_accent, entry);
	};

	// Trim and all userSaid array
	this.sanitizeUserSaid = function(userSaid) {
		var newArray = [];
		for (var i = 0; i < userSaid.length; i++) newArray.push(_this.sanitize(userSaid[i]));
		return newArray;
	};
}

function functionsForMorphing() {

	var _this = this;

	this.checkForSimilateAnswer = function(userSaid, formatedEntries, step, source) {
		// console.log('the entry was not found, we try ressemblance');

		var entryFound = false,
			matches = [];

		for (var entry in formatedEntries) {

			if(!entryFound && _this.wordRessemble(formatedEntries[entry], userSaid[0], step)) {
				matches.push(formatedEntries[entry]);
			}
		}

		// console.log(matches);

		if(matches.length > 1) {
			step = step + 1;
			_this.checkForSimilateAnswer(userSaid, matches, step, source);

		} else if(matches.length === 1) {
			commandsFunctions.pushToPreviouslySaid(matches[0]);
			commandsFunctions.makeAction(entries[matches[0]], source);

		} else if(matches.length === 0 && typeof userSaid[1] !== 'undefined') {
			userSaid.shift();
			_this.checkForSimilateAnswer(userSaid, cleanFunctions.formateEntries(), 1, source);
		}
	};

	this.wordRessemble = function(word1, word2, step) {
		if(word1.substr(0,step) == word2.substr(0,step)) {
			// console.log(word1.substr(0,step) +" == "+ word2.substr(0,step));
			return true;
		}
		return false;
	};
}

function Loader() {

	this.show = function() {
		$('.loader').show();
	};

	this.hide = function() {
		$('.loader').hide();
	};
}

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
	}

	return time;
}

// Return all GET parameters of the URL
function getSearchParameters() {
	var prmstr = window.location.search.substr(1);
	return prmstr !== null && prmstr !== "" ? transformToAssocArray(prmstr) : {};
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

// Copy of urldecode native function of PHP
function urldecode(str) {

  return decodeURIComponent((str + '')
    .replace(/%(?![\da-f]{2})/gi, function() {
      // PHP tolerates poorly formed escape sequences
      return '%25';
    })
    .replace(/\+/g, '%20'));
}

// Return length of an object
Object.size = function (obj) {
    var size = 0;
    for (var key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};

/****************/
/*   LISTENERS  */
/****************/

// Listening top arrow on keyboard to search previous command said
$('input').on('keydown', function(e) {
	// console.log(e.which);

	if(e.which === 38) {
		// console.log(previouslySaid[previouslySaidPosition]);
		// console.log(previouslySaidPosition);

		$('input').val(previouslySaid[previouslySaidPosition]);
		if(previouslySaidPosition > 0) previouslySaidPosition--;

	} else if(e.which === 40) {
		// console.log(previouslySaid[previouslySaidPosition]);
		// console.log(previouslySaidPosition);

		$('input').val(previouslySaid[previouslySaidPosition]);
		if(previouslySaidPosition <= previouslySaid.length) previouslySaidPosition++;
	}
});
