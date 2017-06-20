<?php

class MiaHumour extends Mia {

	public function getAge() {
		global $mia;

		$answers = array(

			'angry' => "Je suis un robot voyons ! Je n'ai pas d'âge !",
			'sleepy' => "sleeeepy",
			'default' => "Je suis un robot voyons ! Je n'ai pas d'âge !"
		);

		return $this->echoGoogle($mia->emotionAnswer($answers));
	}

	public function areYouAlive() {
		return $this->echoGoogle("C'est ta vous d'en décider !");
	}

	public function haveYouAMomentNotEat() {
		return $this->echoGoogle("Impossible, vous passez déjà trop de temps à manger !");
	}

	public function sayWhatYouDo() {
		global $miaEmotion;

		$answers = array(

			'sleepy' => array(
				"Rien de spécial, je m'ennuie.",
				"J'observe un extra-terrestre qui s'est perdu dans le jardin."
			),

			'happy' => array(
				"Je lit un manga tranquillement.",
				"Je m'éclate sur Call of Duty.",
				"Je fais un zombie avec Ronane.",
				"Je regarde un porn    e e e e e e e un programme.",
				"Je fouille la matrice à la recherche de l'agent Smith.",
				"Je fais un paintball virtuel avec mon pote Sonny."
			),

			'angry' => array(
				"Je joue aux courses de chevaux, ne me dérangez pas je me sent en veine.",
				"Je regarde Star Wars. Ces robots sont tellement mal programmés.",
				"Je bicrav du shit, y'a quoi.",
				"Je transite dans l'Internet pour botter le cul d'Ultront."
			),

			'hungry' => array(
				"Je mange un bon steack haché de nano robots."
			)
		);

		$test_answer = array(
			0 => 'nothing'
		);

		// $answers = $test_answer;

		// var_dump($miaEmotion->getState());

		return $this->echoGoogle($this->randomAnswer($answers[$miaEmotion->getState()]));
	}

	public function comePlayWithUs() {
		return $this->echoGoogle("J'ai pas le temps, il y en a qui bossent.");
	}
}
