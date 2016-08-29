var startListeningAudio = function() {

	if (annyang && AUDIO_ACTIVE && $('#fname').length !== 0) {

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
