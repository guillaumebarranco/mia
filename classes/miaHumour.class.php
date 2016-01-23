<?php

class MiaHumour extends Mia {

	public function getAge() {
		return $this->echoGoogle("Je suis un robot voyons ! Je n'ai pas d'âge !");
	}

	public function areYouAlive() {
		return $this->echoGoogle("C'est ta vous d'en décider !");
	}

	public function sayWhatYouDo() {

		$answers = array(
			0 => "Rien de spécial, je m'ennuie.",
			1 => "J'observe un extra-terrestre qui s'est perdu dans le jardin.",
			2 => "Je joue aux courses de chevaux, ne me dérangez pas je me sent en veine.",
			3 => "Je lit un manga tranquillement.",
			4 => "Je m'éclate sur Call of Duty."
		);

		return $this->echoGoogle($answers[rand(0, count($answers))]);
	}

}
