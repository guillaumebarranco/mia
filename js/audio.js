var startListeningAudio = function() {

	if (annyang && AUDIO_ACTIVE) {

		annyang.setLanguage('fr-FR');

		annyang.start({
			autoRestart: true
		});

		annyang.addCallback('result', function (userSaid) {

			newArray = cleanFunctions.sanitizeUserSaid(userSaid);
			console.log(newArray);

			commandsFunctions.searchCommand(newArray, 'audio');
		});
	}
};
