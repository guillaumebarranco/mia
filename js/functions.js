var previouslySaid 				= [],
	previouslySaidPosition 		= -1,
	commandsFunctions 			= new echoCommand(),
	cleanFunctions 				= new functionsForClean(),
	morphingFunctions 			= new functionsForMorphing(),
	myLoader 					= new Loader(),
	aiFunctions					= new artificalIntelligence(),
	jsFunctions					= new functionsForJavascript(),
	launchLoader 				= true,
	canReact 					= true,
	google_translate_length = 63
;

function echoCommand() {

	var _this = this;

	// First called function
	this.searchCommand = function(userSaid, source) {

		console.log(userSaid);

		if(_this.searchCustomCommand(userSaid)) {

			if(canReact) {

				if(in_array('répète', userSaid)) {
					if(typeof previouslySaid[0] !== 'undefined') _this.searchForMatchingAnswers(previouslySaid, entries, privateEntries, source);
				}

				if(in_array('combien de commandes possèdes tu', userSaid)) {
					_this.getMiaAnswer(
						'Je possède '+Object.size(entries)+' commandes et '+Object.size(privateEntries)+' commandes privées.'
					, 'write', false);
					return;
				}

				_this.searchForMatchingAnswers(userSaid, entries, privateEntries, source);

			} else {
				if(in_array('démarre', userSaid)) canReact = true;
			}
		}
	};

	this.searchCustomCommand = function(userSaid) {

		if(in_array('stop', userSaid)) canReact = false;
		if(in_array('recharge', userSaid)) location.reload();

		if(userSaid[0].substr(0,7) === 'caniuse') {
			_this.makeAction(userSaid[0], source);
			return false;
		}

		return jsFunctions.searchCalcul(userSaid[0]);
	};

	// Search for entries in userSaid
	this.searchForMatchingAnswers = function(userSaid, entries, privateEntries, source) {

		for (var i = 0; i < userSaid.length; i++) {
			if(typeof entries[cleanFunctions.sanitize(userSaid[i])] != 'undefined') {
				entryFound = true;
				commandsFunctions.pushToPreviouslySaid(userSaid[i]);
				_this.makeAction(entries[cleanFunctions.sanitize(userSaid[i])], source);
				return;
			}
		}

		for (var j = 0; j < userSaid.length; j++) {

			if(typeof privateEntries[cleanFunctions.sanitize(userSaid[j])] != 'undefined') {
				entryFound = true;
				commandsFunctions.pushToPreviouslySaid(userSaid[i]);
				_this.makeAction(privateEntries[cleanFunctions.sanitize(userSaid[j])], source);
				return;
			}
		}

		morphingFunctions.checkForSimilateAnswer(userSaid, cleanFunctions.formateEntries(), 1, source);
	};

	// From eventually GET Parameters, we check if the answer is made by audio or not
	this.getResponseUrl = function(text, source) {
		url = MIA_URL;

		if(typeof getSearchParameters().overwrite !== 'undefined' /*|| source !== 'writing'*/) url += JS_URL;

		url += 'functions.php?text='+text+'&source=js';
		return url;
	};

	// After the AJAX response, make Mia answer to what you said
	this.getMiaAnswer = function(responseText, source, cutText) {

		if(typeof cutText === 'undefined') var cutText = true;

		var google_translate_length = 63;

		$('iframe').remove();
		$('h3').empty();

		var subtext = (cutText) ? responseText.substr(google_translate_length) : responseText;

		var time = getTimeTalkByText(subtext),
			responseHtml = (source === 'audio') ? '<iframe style="opacity:0;" src="'+responseText+'"></iframe>' : '<h3>'+urldecode(subtext)+'</h3>';

		$('#main').append(responseHtml);

		$('#mouth').addClass('anim');
		setTimeout(function() { $('#mouth').removeClass('anim'); }, time * 1000);
	};

	this.transformToText = (audioText) => {
		var subtext = audioText.substr(google_translate_length);
		return urldecode(subtext);
	};

	// Action sending params to mia core
	this.makeAction = function(text, source, callback) {

		$('#main').empty();
		console.log(text);

		var url = _this.getResponseUrl(text, source);
		
		setTimeout(function() { if(launchLoader) myLoader.show(); }, 300);

		$.ajax({
			url: url,
			type: 'GET',
			success: function(response) {
				response = JSON.parse(response);
				console.log(response);

				myLoader.hide();
				if(!callback) _this.getMiaAnswer(response.text, source);
				if(callback) callback(response);

			}, error: function() {
				myLoader.hide();
			}
		});
	};

	// Push the last said word in the previouslySaid tab to find it again with bottom/top arrows
	this.pushToPreviouslySaid = function(word) {
		previouslySaid.push(word);
		previouslySaidPosition++;
	};
}

function functionsForJavascript() {
	var _this = this;

	this.searchCalcul = function(entry) {
		var foundMatch = false;

		// Soustraction
		if( /^[0-9]*-[0-9]*$/ .test(entry)) {

			var nbs = entry.split("-"),
				result = parseInt(nbs[0]) - parseInt(nbs[1]);

			commandsFunctions.getMiaAnswer(result, 'write', false);
			foundMatch = true;
		}

		// Addition
		if( /^[0-9]*\+[0-9]*$/ .test(entry)) {

			var nbs = entry.split("+"),
				result = parseInt(nbs[0]) + parseInt(nbs[1]);

			commandsFunctions.getMiaAnswer(result, 'write', false);
			foundMatch = true;
		}

		// Multiplication
		if( /^[0-9]*\*[0-9]*$/ .test(entry)) {

			var nbs = entry.split("*"),
				result = parseInt(nbs[0]) * parseInt(nbs[1]);

			commandsFunctions.getMiaAnswer(result, 'write', false);
			foundMatch = true;
		}

		// Division
		if( /^[0-9]*\/[0-9]*$/ .test(entry)) {

			var nbs = entry.split("/"),
				result = parseInt(nbs[0]) / parseInt(nbs[1]);

			commandsFunctions.getMiaAnswer(result, 'write', false);
			foundMatch = true;
		}

		return !foundMatch;
	};
}

function artificalIntelligence() {

	var _this = this;

	var questions = [
		"combien",
		"pourquoi",
		"comment",
		"qui",
		"quand"
	];

	// Launched when no corresponding entry was found
	this.decomposeEntry = function(entry) {
		var first_word = entry[0]; // Regex

		console.log(questions[first_word]);

		if(questions.indexOf(first_word) !== -1) {
			_this.beginResearch(entry);
		}
	};

	this.beginResearch = function(question) {
		console.log('beginResearch');

		$.ajax({
			url: 'functions.php?action=searchGoogle?question='+question,
			type: 'GET',

			success: function(response) {
				response = JSON.parse(response);
				console.log(response);

			}, error: function() {
			}
		});
	};
}

function functionsForClean() {

	var _this = this;

	// Converting and return the Object "entries" in Array (without modification to original "entries" var)
	this.formateEntries = function() {
		var formatedEntries = [];
		for (var entry in entries) formatedEntries.push(entry);
		return formatedEntries;
	};

	// Function for sanitize all entries (accents, trim, toLowerCase)
	this.sanitize = function(entry) {
		
		var pattern_accent 				= new Array("é", "è", "ê", "ë", "ç", "à", "â", "ä", "î", "ï", "ù", "ô", "ó", "ö", "-"),
			pattern_replace_accent 		= new Array("e", "e", "e", "e", "c", "a", "a", "a", "i", "i", "u", "o", "o", "o", " ");

		entry = entry.toLowerCase().trim();

		return preg_replace(pattern_accent, pattern_replace_accent, entry);
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

		var entryFound = false,
			matches = [];

		for (var entry in formatedEntries) {

			if(!entryFound && _this.wordRessemble(formatedEntries[entry], userSaid[0], step)) {
				matches.push(formatedEntries[entry]);
			}
		}

		if(matches.length > 1) {
			step++;
			_this.checkForSimilateAnswer(userSaid, matches, step, source);

		} else if(matches.length === 1) {
			commandsFunctions.pushToPreviouslySaid(matches[0]);
			commandsFunctions.makeAction(entries[matches[0]], source);

		} else if(matches.length === 0 && typeof userSaid[1] !== 'undefined') {
			userSaid.shift();
			_this.checkForSimilateAnswer(userSaid, cleanFunctions.formateEntries(), 1, source);
		} else {
			aiFunctions.decomposeEntry(userSaid);
		}
	};

	this.wordRessemble = function(word1, word2, step) {
		if(word1.substr(0,step) == word2.substr(0,step)) return true;
		return false;
	};
}

function Loader() {

	this.show = function() {
		$('.loader').show();
	};

	this.hide = function() {

		launchLoader = false;
		$('.loader').hide();

		setTimeout(function() { launchLoader = true; }, 300);
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
