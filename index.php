<!DOCTYPE>

<html lang="fr">
	<head>
		<title>Mia</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
	</head>

	<body>

		<p>Just say something</p>

		<div id="main"></div>

		<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/annyang/2.0.0/annyang.min.js"></script>

		<script>

			function getSearchParameters() {
			      var prmstr = window.location.search.substr(1);
			      return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
			}

			function transformToAssocArray( prmstr ) {
			    var params = {};
			    var prmarr = prmstr.split("&");
			    for ( var i = 0; i < prmarr.length; i++) {
			        var tmparr = prmarr[i].split("=");
			        params[tmparr[0]] = tmparr[1];
			    }
			    return params;
			}

			var params = getSearchParameters();

			function makeAction(text) {
				// window.location.href = window.location.href+'/?text=temperature';

				$('iframe').remove();

				$.ajax({
					url: 'functions.php?text='+text,
					type: 'GET',

					success: function(response) {
						console.log(response);
						$('#main').append('<iframe style="opacity:0;" src="'+response+'" autoplay></iframe>')
					}
				});
			}

			var startListeningAudio = function () {

				if (annyang) {
					var commands = {
						'what is the date today': function home() {
							makeAction('date');
						},
						'what time is it': function home() {
							makeAction('hour');
						},
						'what is the temperature': function home() {
							makeAction('temperature');
						},
						'how many trophies': function home() {
							makeAction('trophies');
						},
						'what is the day': function home() {
							makeAction('fete');
						},
						'what is your name': function home() {
							makeAction('name');
						},
						'what is your function': function home() {
							makeAction('robot');
						},
						'how old are you': function home() {
							makeAction('age');
						},
						'what commands you': function home() {
							makeAction('rule');
						},
						'what is the first law': function home() {
							makeAction('first_law');
						},
						'what is the second law': function home() {
							makeAction('second_law');
						},
						'what is the third law': function home() {
							makeAction('third_law');
						},
						'do you want a joke': function home() {
							makeAction('wantAJoke');
						},
						'what do you want': function home() {
							makeAction('whatYouWant');
						},
						'are you fine': function home() {
							makeAction('areYouFine');
						},
						'hello': function home() {
							makeAction('hello');
						},
						'fine thank you': function home() {
							makeAction('wellFine');
						},
						'bemol': function home() {
							makeAction('bemol');
						},
						'good night': function home() {
							makeAction('goodNight');
						},

						'i am going to sleep': function home() {
							makeAction('goToSleep');
						},

					};

					annyang.addCommands(commands);
					annyang.start();
				}
			};

			$(document).ready(function() {

				if(typeof params.text === 'undefined') {
					startListeningAudio();
				}
			});

		</script>

	</body>
</html>
