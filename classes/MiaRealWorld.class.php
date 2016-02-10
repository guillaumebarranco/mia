<?php

class MiaRealWorld extends Mia {

	private $led_path = "/sys/class/leds/led1";

	public function turnOnLight() {

		$koko = exec("cat ".$this->led_path."/brightness");

		if($koko === "255") {
			return $this->echoGoogle('La lumière est déjà allumée.');
		}

		$koko = exec("echo 255 > ".$this->led_path."/brightness");

		return $this->echoGoogle('La lumière a été allumée');
	}

	public function turnOffLight() {

		$koko = exec("cat ".$this->led_path."/brightness");

		if($koko === "0") {
			return $this->echoGoogle('La lumière est déjà éteinte.');
		}

		$koko = exec("echo 0 > ".$this->led_path."/brightness");

		return $this->echoGoogle('La lumière a été éteinte');
	}
}
