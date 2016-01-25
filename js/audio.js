var startListeningAudio = function() {

	if (annyang) {

		annyang.setLanguage('fr-FR');

		annyang.start({
			autoRestart: true
		});

		annyang.addCallback('result', function (userSaid, commandText, phrases) {

			newArray = sanitizeUserSaid(userSaid);
			console.log(newArray);

			if(in_array('stop', newArray)) annyang.abort();

			if(in_array('combien de commandes possèdes-tu', newArray)) {
				speakFromJavascript('Je possède '+Object.size(entries)+' commandes et '+Object.size(privateEntries)+' commandes privées.');
			}

			checkArray(newArray, entries, privateEntries);
		});
	}

};
