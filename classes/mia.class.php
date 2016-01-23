<?php

define('GOOGLE2', "http://translate.google.com/translate_tts?tl=fr&client=tw-ob&q=");

class Mia {
	private $voice;
	private $name = 'Mia';

	public function __construct() {}

	public function echoGoogle($content) {
		return GOOGLE2.urlencode($content);
	}

	public function sayName() {
		return $this->echoGoogle("Mon nom est ".$this->name);
	}

	function sayFunction() {
		return $this->echoGoogle("Je suis votre robot personnel.");
	}

	public function sayYes() {
		return $this->echoGoogle('Oui');
	}

	public function sayNo() {
		return $this->echoGoogle('Non');
	}

	public function sayNoThanks() {
		return $this->echoGoogle('Non merci.');
	}

	public function sayHello() {
		return $this->echoGoogle('Bonjour ! Comment allez vous ?');
	}

	public function sayAlright() {
		return $this->echoGoogle('Tant mieux !');
	}

	public function sayGoodNight() {
		return $this->echoGoogle('Bonne nuit !');
	}

	public function sayGoodNightToo() {
		return $this->echoGoogle('Bonne nuit à vous aussi !');
	}

	public function sayOfCourse() {
		return $this->echoGoogle('Evidemment !');
	}



}