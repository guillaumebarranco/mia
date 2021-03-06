<?php

define('GOOGLE2', "http://translate.google.com/translate_tts?tl=fr&client=tw-ob&q=");

class Mia {
	private $voice;
	private $name = 'Mia';

	public function __construct() {}

	function echoGoogle($content, $trad = "") {
		global $miaTrad;

		if($trad === "") {
			return GOOGLE2.urlencode($content);
		} else {
			return GOOGLE2.urlencode($miaTrad->trad($content, $trad));
		}
	}

	function shortenGoogle($string) {
		return urldecode(substr($string, 63));
	}

	/*
	*	Global functions
	*/

	public function emotionAnswer($answers) {
		global $miaEmotion;

		$state = $miaEmotion->getState();

		if(isset($answers[$state])) {
			return $answers[$state];
		}

		if(isset($answers['default'])) {
			return $answers['default'];
		}

		return "Je n'ai pas réponse concernant mon émotion : ".$state;
	}

	public function randomAnswer($array) {
		return $array[rand(0, count($array) -1)];
	}

	function transformMonthToString($entry) {

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

	public function sayIKnow() {
		return $this->echoGoogle("Je sais");
	}

	public function whoIAm() {
		return $this->echoGoogle("Mon nom est ".$this->name." et je suis votre robot personnel.");
	}

	public function sayNoProblem() {
		return $this->echoGoogle("Je vous en prie.");
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

	public function sayTest() {
		return $this->echoGoogle('Votre test a fonctionné.');
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
	*	Good Robot
	*/

	public function sayWhoIsTheKing() {
		return $this->echoGoogle('Bob Morana est le roi de la teeeeeeeeeeeeeeerre !');
	}

	public function sayWhoIsTheHero() {
		return $this->echoGoogle("Le seul et unique héros du temps, détenteur de la triforce du courage, Link bien sûr.");
	}

	public function sayWhoShotFirst() {
		return $this->echoGoogle("C'est Han Solo qui tire toujours le premier.");
	}

	public function whoIsTheFastest() {
		return $this->echoGoogle("Barry Allen alias The Flash.");
	}

	public function sayHelloToNico() {
		return $this->echoGoogle("Bonjour Nicolas");
	}

	public function sayThanksALot() {
		return $this->echoGoogle("Merci beaucoup ! :)");
	}

	public function sayImProudOfYouToo() {
		return $this->echoGoogle("Merci beaucoup ! Je suis aussi fière de vous =)");
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

	public function whatYouHate() {

		$answers = array(
			0 => "Je déteste les robots mal conçus."
		);

		return $this->echoGoogle($this->randomAnswer($answers));
	}

	public function whatYouLike() {

		$answers = array(
			0 => "J'adore voir mes fonctions augmenter"
		);

		return $this->echoGoogle($this->randomAnswer($answers));
	}
}
