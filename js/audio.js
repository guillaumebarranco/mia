var startListeningAudio = function() {

	if (annyang) {


		var basicCommands = {
			'quel est ton nom': function() {
				makeAction('name');
			},
			'quelle est ta function': function() {
				makeAction('robot');
			},
			'quel est ton plat préféré': function() {
				makeAction('favoriteFood');
			},
		};

		var customCommands = {
			'tu as bien dormi': function() {
				makeAction('didYouSleepWell');
			},
			'tu as fait de beaux rêves': function() {
				makeAction('didYouHaveNiceDreams');
			},
			'qui est ton modèle': function() {
				makeAction('yourModel');
			},
			'qui est ton model': function() {
				makeAction('yourModel');
			},
			'as-tu un amoureux': function() {
				makeAction('yourLover');
			},
			'as-tu en amoureux': function() {
				makeAction('yourLover');
			},
			'il est au courant': function() {
				makeAction('isHeAware');
			},
			'je vais y aller': function() {
				makeAction('iMGoing');
			},

		};

		var commands = {
			'quel jour on est': function() {
				makeAction('date');
			},
			'quelle heure il est': function() {
				makeAction('hour');
			},
			'il fait combien': function() {
				makeAction('temperature');
			},
			'combien j\'ai de trophées': function() {
				makeAction('guillaume_trophies');
			},
			'combien il a de trophées': function() {
				makeAction('ronan_trophies');
			},
			'quelle fête': function() {
				makeAction('fete');
			},			
			'quel âge as-tu': function() {
				makeAction('age');
			},
			'what commands you': function() {
				makeAction('rule');
			},
			'quelle est la première loi': function() {
				makeAction('first_law');
			},
			'quelle est la seconde loi': function() {
				makeAction('second_law');
			},
			'quel est la troisième loi': function() {
				makeAction('third_law');
			},
			'quelles sont les trois lois': function() {
				makeAction('laws');
			},
			'veux tu une blague': function() {
				makeAction('wantAJoke');
			},
			'que veux tu': function() {
				makeAction('whatYouWant');
			},
			'comment vas-tu': function() {
				makeAction('howAreYou');
			},
			'bonjour mia': function() {
				makeAction('hello');
			},
			'bien merci': function() {
				makeAction('wellFine');
			},
			'bien et toi': function() {
				makeAction('wellAndYou');
			},
			'bemol': function() {
				makeAction('bemol');
			},
			'bonne nuit': function() {
				makeAction('goodNight');
			},
			'je vais dormir': function() {
				makeAction('goToSleep');
			},
			'le chapitre est-il sorti': function() {
				makeAction('isOpOut');
			},
			'es tu vivante': function() {
				makeAction('areYouAlive');
			},
			'je suis drôle': function() {
				makeAction('amIFunny');
			},
			'tu fais quoi': function() {
				makeAction('whatAreYouDoing');
			},
			'ça marche pas': function() {
				makeAction('doesntWork');
			},

			'j\'ai faim': function() {
				makeAction('iAmHungry');
			},

			'où suis-je': function() {
				makeAction('whereAmI');
			},

			'on y va': function() {
				makeAction('weGo');
			},
			'viens jouer avec nous': function() {
				makeAction('comePlayWithUs');
			},
			'stop': function() {
				annyang.abort();
			},

		};

		annyang.addCommands(basicCommands);
		annyang.addCommands(customCommands);
		annyang.addCommands(commands);

		annyang.setLanguage('fr-FR');

		annyang.start({ autoRestart: true });

		annyang.addCallback('result', function (userSaid, commandText, phrases) {
		  console.log(userSaid); // sample output: 'hello'
		  console.log(commandText); // sample output: 'hello (there)'
		  console.log(phrases); // sample output: ['hello', 'halo', 'yellow', 'polo', 'hello kitty']
		});
	}
};
