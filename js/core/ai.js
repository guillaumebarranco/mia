class AI {

	constructor() {

		this.questions = [
			"combien",
			"pourquoi",
			"comment",
			"qui",
			"quand"
		];
	}

	checkForSimilateAnswer(userSaid, formatedEntries, step, source) {

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
	}

	wordRessemble(word1, word2, step) {
		if(word1.substr(0,step) == word2.substr(0,step)) return true;
		return false;
	}

	// Launched when no corresponding entry was found
	decomposeEntry(entry) {

		const first_word = entry[0]; // Regex

		console.log(questions[first_word]);

		if(questions.indexOf(first_word) !== -1) {
			this.beginResearch(entry);
		}
	}

	beginResearch(question) {

		console.log('beginResearch');

		$.ajax({
			url: 'functions.php?action=searchGoogle?question='+question,
			type: 'GET',

			success: (response) => {
				response = JSON.parse(response);
				console.log('beginResearch, response', response);

			}, error: (error) => {
			}
		});
	}
}