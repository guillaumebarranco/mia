<?php

class MiaKnowledge extends Mia {

	public function getFirstLaw() {
		return $this->echoGoogle("Première loi : Un robot ne peut pas faire de mal à un être humain.");
	}

	public function getSecondLaw() {
		return $this->echoGoogle("Seconde loi : Un robot doit obéir à tout ordre qui lui est donné par un humain.");
	}

	public function getThirdLaw() {
		return $this->echoGoogle("Troisième loi : Un robot à le droit de se défendre, tant que cela n'entre pas en collision avec la première ou la seconde loi.");
	}

	public function getThreeLaws() {
		return $this->echoGoogle("Première loi : Un robot ne peut pas faire de mal à un être humain. Seconde loi : Un robot doit obéir à tout ordre qui lui est donné par un humain. Troisième loi : Un robot à le droit de se défendre, tant que cela n'entre pas en collision avec la première ou la seconde loi.");
	}

	public function RikuFavoriteManga() {
		return $this->echoGoogle("Le manga favori de Kevin est Gintama.");
	}

	public function HikenFavoriteManga() {
		return $this->echoGoogle("Le manga favori de Médrick est Jojo's bizarre adventure.");
	}

	public function whatDoIDo() {

		$answers = array(
			0 => "Cela fait longtemps que vous n'avez pas lu Kenshin."
		);

		return $this->echoGoogle($this->randomAnswer($answers));
	}

	public function itAngersMe() {

		$answers = array(
			0 => "Que se passe t-il ?"
		);

		return $this->echoGoogle($this->randomAnswer($answers));
	}

	/*
	/
	*/

	public function ownerFavoriteManga() {
		
	}

}