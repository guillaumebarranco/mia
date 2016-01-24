var startListeningAudio = function() {

	if (annyang) {

		annyang.setLanguage('fr-FR');

		annyang.start({
			autoRestart: true
		});

		annyang.addCallback('result', function (userSaid, commandText, phrases) {

			var newArray = [];
			for (var i = 0; i < userSaid.length; i++) newArray.push(userSaid[i].toLowerCase().trim());
			console.log(newArray);

			if(in_array('stop', newArray)) annyang.abort();
			if(in_array('combien de commandes possèdes-tu', newArray)) speakFromJavascript('Je possède '+Object.size(entries)+' commandes');

			function checkArray() {
				var entryFound = false;

				for (var i = 0; i < newArray.length; i++) {
					if(!entryFound) {

						if(typeof entries[newArray[i]] != 'undefined') {
							entryFound = true;
							makeAction(entries[newArray[i]]);
						}
					}
				}
			}

			checkArray();

		});
	}

};
