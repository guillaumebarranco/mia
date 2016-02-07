<?php

class MiaRealWorld extends Mia {

	public function brightLight() {

		$koko = exec("cat /sys/class/leds/led1/brightness");

		if($koko === "255") {
			return $this->echoGoogle('La lumière est déjà allumée.');
		}

		return $this->echoGoogle('La lumière a été allumée');
	}
}
