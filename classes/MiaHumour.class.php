<?php

class MiaHumour extends Mia {

	public function getAge() {
		return $this->echoGoogle("Je suis un robot voyons ! Je n'ai pas d'âge !");
	}

	public function areYouAlive() {
		return $this->echoGoogle("C'est ta vous d'en décider !");
	}

	public function haveYouAMomentNotEat() {
		return $this->echoGoogle("Impossible, vous passez déjà trop de temps à manger !");
	}

	public function sayWhatYouDo() {

		$answers = array(
			0 => "Rien de spécial, je m'ennuie.",
			1 => "J'observe un extra-terrestre qui s'est perdu dans le jardin.",
			2 => "Je joue aux courses de chevaux, ne me dérangez pas je me sent en veine.",
			3 => "Je lit un manga tranquillement.",
			4 => "Je m'éclate sur Call of Duty.",
			5 => "Je fais un zombie avec Ronane.",
			6 => "Je mange un bon steack haché de nano robots.",
			7 => "Je regarde un porn    e e e e e e e un programme.",
			8 => "Je bicrav du shit, y'a quoi.",
			9 => "Je transite dans l'Internet pour botter le cul d'Ultront.",
			10 => "Je fouille la matrice à la recherche de l'agent Smith.",
			11 => "Je fais un paintball virtuel avec mon pote Sonny.",
			12 => "Je regarde Star Wars. Ces robots sont tellement mal programmés.",
			// 13 => "",
			// 14 => "",
			// 15 => "",
			// 16 => "",
			// 17 => "",
			// 18 => "",
			// 19 => "",
		);
		
		// 7084 + 5284 + 1400
		// 4580

		$test_answer = array(
			0 => 'nothing'
		);

		// $answers = $test_answer;

		return $this->echoGoogle($this->randomAnswer($answers));
	}

	public function comePlayWithUs() {
		return $this->echoGoogle("J'ai pas le temps, il y en a qui bossent.");
	}

}
