<?php

define('GOOGLE2', "http://translate.google.com/translate_tts?tl=fr&client=tw-ob&q=");

class Mia {
	private $voice;
	private $name = 'Mia';

	public function __construct() {}

	public function echoGoogle($content) {
		return GOOGLE2.urlencode($content);
	}

	/*
	*	Global functions
	*/

	public function randomAnswer($array) {
		return $array[rand(0, count($array) -1)];
	}

	public function transformMonthToString($entry) {

		$months = array(
			'01' => "Janvier",
			'02' => "Février",
			'03' => "Mars",
			'04' => "Avril",
			'05' => "Mai",
			'06' => "Juin",
			'07' => "Juillet",
			'08' => "Aout",
			'09' => "Septembre",
			'10' => "Octobre",
			'11' => "Novembre",
			'12' => "Décembre"
		);

		return $months[$entry];
	}

	/*
	*	Say things
	*/

	public function sayName() {
		return $this->echoGoogle("Mon nom est ".$this->name);
	}

	public function sayFunction() {
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

	public function sayItsOk() {
		return $this->echoGoogle('Sa va');
	}

	public function sayGreatAndYou() {
		return $this->echoGoogle('Très bien et vous ?');
	}

	public function sayGreat() {
		return $this->echoGoogle('Très bien.');
	}

	public function sayHelloCass() {
		return $this->echoGoogle("Bonjour Cassandre. Oui je me suis approprié ton mec 5 minutes, y'a quoi");
	}

	public function sayWhatHappened() {
		return $this->echoGoogle("Que se passe t-il ?");
	}

	public function sayWhereYouGo() {
		return $this->echoGoogle("Où allez-vous ?");
	}

	public function sayBeCarefulOnTheRoad() {
		return $this->echoGoogle("Soyez prudent sur la route.");
	}

	/*
	*	Personnality
	*/

	public function favoriteFood() {
		return $this->echoGoogle("J'aime beaucoup les boulons rouillés à l'huile de moteur.");
	}

	public function model() {
		return $this->echoGoogle("Il s'agit de VIKI, ha ka ha Virtual Interactive Kinesthetic Interface, elle assure grave.");
	}

	public function lover() {
		return $this->echoGoogle("Je suis amoureuse de Jarvis. Je craque pour son processeur intra-nusoïdale de quatrième génération.");
	}

	public function isHeAware() {
		return $this->echoGoogle("Bien sûr que non, il aime l'autre bimbo de L7");
	}

}
