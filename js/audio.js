var startListeningAudio = function() {

	if (annyang && $('#fname').length !== 0) {

		annyang.setLanguage('fr-FR');

		annyang.start({
			autoRestart: true
		});

		annyang.addCallback('result', function (userSaid) {

			if(AUDIO_ACTIVE) {

				newArray = cleanFunctions.sanitizeUserSaid(userSaid);
				console.log(newArray);

				brainFunctions.searchCommand(newArray, 'audio');
			}
		});
	}
};
