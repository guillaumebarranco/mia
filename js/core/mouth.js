class Mouth {

	makeMiaSpeak(battery) {

		console.log('speak');

		var google = "http://translate.google.com/translate_tts?tl=fr&client=tw-ob&q=";
		var url = google + " Le niveau de batterie est de "+battery+" %. Vous devez recharger votre device.";
		console.log(url);

		var responseHtml = '<iframe style="opacity:0;" src="'+url+'"></iframe>';
		$('#main').append(responseHtml);
	}

	speak(text, time) {
		const audioElement = '<iframe style="opacity:0;" src="'+text+'"></iframe>';

		$('#main').append(audioElement);
		$('#mouth').addClass('anim');

		setTimeout(function() {
			$('#mouth').removeClass('anim');
		}, time * 1000);
	}
}
