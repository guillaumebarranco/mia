var startListeningAudio = function() {

	if (annyang) {

		annyang.setLanguage('fr-FR');

		annyang.start({
			autoRestart: true
		});

		annyang.addCallback('result', function (userSaid, commandText, phrases) {

			console.log(userSaid); // sample output: 'hello'

			function said(needle) {
				return in_array(needle, userSaid);
			}

			if(said('stop')) annyang.abort();

			/*
			*	Functions
			*/

			var basic = function() {

				if(said('bonjour mia')) 				makeAction('hello');
				if(said('quel est ton nom'))			makeAction('name');
				if(said('quelle est ta function'))		makeAction('robot');
				if(said('quel est ton plat préféré'))	makeAction('favoriteFood');

			}();

			var friends = function() {

				if(said('quel est le manga favori de M')) makeAction('hikenFavoriteManga');

			}();

			var custom = function() {
				if(said('tu as bien dormi'))			makeAction('didYouSleepWell');
				if(said('tu as fait de beaux rêves'))	makeAction('didYouHaveNiceDreams');
				if(said('qui est ton modèle'))			makeAction('yourModel');
				if(said('qui est ton model'))			makeAction('yourModel');
				if(said('as-tu un amoureux'))			makeAction('yourLover');
				if(said('as-tu en amoureux'))			makeAction('yourLover');
				if(said('il est au courant'))			makeAction('isHeAware');
				if(said('je vais y aller'))				makeAction('iMGoing');
			}();

			var commands = function() {

				if(said('quel jour on est'))				makeAction('date');
				if(said('quelle heure il est'))				makeAction('hour');
				if(said('il fait combien'))					makeAction('temperature');
				if(said('combien j\'ai de trophées'))		makeAction('guillaume_trophies');
				if(said('combien il a de trophées'))		makeAction('ronan_trophies');
				if(said('quelle fête'))						makeAction('fete');
				if(said('quel âge as-tu'))					makeAction('age');
				if(said('what commands you'))				makeAction('rule');
				if(said('quelle est la première loi'))		makeAction('first_law');



				if(said('quelle est la seconde loi'))		makeAction('second_law');
				if(said('quel est la troisième loi'))		makeAction('third_law');
				if(said('quelles sont les trois lois'))		makeAction('laws');
				if(said('veux tu une blague'))				makeAction('wantAJoke');
				if(said('que veux tu'))						makeAction('whatYouWant');
				if(said('comment vas-tu'))					makeAction('howAreYou');
				if(said('bien merci'))						makeAction('wellFine');
				if(said('bien et toi'))						makeAction('wellAndYou');
				if(said('bemol'))							makeAction('bemol');
				if(said('bonne nuit'))						makeAction('goodNight');
				if(said('je vais dormir'))					makeAction('goToSleep');
				if(said('le chapitre est-il sorti'))		makeAction('isOpOut');


				if(said('es tu vivante'))					makeAction('areYouAlive');
				if(said('je suis drôle'))					makeAction('amIFunny');
				if(said('tu fais quoi'))					makeAction('whatAreYouDoing');
				if(said('ça marche pas'))					makeAction('doesntWork');
				if(said('j\'ai faim'))						makeAction('iAmHungry');
				if(said('où suis-je'))						makeAction('whereAmI');
				if(said('on y va'))							makeAction('weGo');
				if(said('viens jouer avec nous'))			makeAction('comePlayWithUs');

			}();

		});
	}

	function in_array(needle, haystack) {

		var newArray = [];

		for (var i = 0; i < haystack.length; i++) newArray.push(haystack[i].toLowerCase());

		if(haystack.indexOf(needle.toLowerCase()) != -1) return true;

		return false;
	}
};
