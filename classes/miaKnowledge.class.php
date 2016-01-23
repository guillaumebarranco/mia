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
}
