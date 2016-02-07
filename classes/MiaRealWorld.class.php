<?php

class MiaRealWorld extends Mia {

	public function turnOnLight() {

		$koko = exec("cat /sys/class/leds/led1/brightness");

		if($koko === "255") {
			return $this->echoGoogle('La lumière est déjà allumée.');
		}

		$koko = exec("echo 255 > /sys/class/leds/led1/brightness");

		return $this->echoGoogle('La lumière a été allumée');
	}

	public function turnOffLight() {

		$koko = exec("cat /sys/class/leds/led1/brightness");

		if($koko === "0") {
			return $this->echoGoogle('La lumière est déjà éteinte.');
		}

		$koko = exec("echo 0 > /sys/class/leds/led1/brightness");

		return $this->echoGoogle('La lumière a été éteinte');
	}
}
