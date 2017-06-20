class Brain {

	searchCommand(userSaid, source) {

		console.log('userSaid', userSaid);

		if(this.searchCustomCommand(userSaid) && canReact) {
			this.searchForMatchingAnswers(userSaid, source);
		}
	}

	searchCustomCommand(userSaid) {

		if(in_array('démarre', userSaid)) {
			canReact = true;
		}

		if(in_array('stop', userSaid)) {
			canReact = false;
		}

		if(in_array('recharge', userSaid)) {
			location.reload();
		}

		if(in_array('dis bonjour à', userSaid)) {
			console.log('ok');
		}

		if(in_array('répète', userSaid) && typeof previouslySaid[0] !== 'undefined') {
			this.searchForMatchingAnswers(previouslySaid, entries, privateEntries, source);
		}

		if(in_array('combien de commandes possèdes tu', userSaid)) {

			this.getMiaAnswer(
				'Je possède '+Object.size(entries)+' commandes et '+Object.size(privateEntries)+' commandes privées.'
			, 'write', false);
			return;
		}

		if(userSaid[0].substr(0,7) === 'caniuse') {
			commandsFunctions.makeAction(userSaid[0], source);
			return false;
		}

		if(userSaid[0].substr(0,4) === "def:") {
			commandsFunctions.makeActionWithGetParams('singleDefinition', 'js', "&definition="+userSaid[0].substr(4));
			return false;
		}

		return calculFunctions.searchCalcul(userSaid[0]);
	}

	// Search for entries in userSaid
	searchForMatchingAnswers(userSaid, source) {

		let entryFound = false;

		for (let i = 0; i < userSaid.length; i++) {

			if(typeof entries[cleanFunctions.sanitize(userSaid[i])] !== 'undefined') {

				entryFound = true;
				commandsFunctions.pushToPreviouslySaid(userSaid[i]);
				commandsFunctions.makeAction(entries[cleanFunctions.sanitize(userSaid[i])], source);
				return;
			}
		}

		for (let j = 0; j < userSaid.length; j++) {

			if(typeof privateEntries[cleanFunctions.sanitize(userSaid[j])] !== 'undefined') {
				entryFound = true;
				commandsFunctions.pushToPreviouslySaid(userSaid[i]);
				commandsFunctions.makeAction(privateEntries[cleanFunctions.sanitize(userSaid[j])], source);
				return;
			}
		}

		aiFunctions.checkForSimilateAnswer(userSaid, cleanFunctions.formateEntries(), 1, source);
	}
}
