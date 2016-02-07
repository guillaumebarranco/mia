<?php

class MiaRealWorld extends Mia {

	public function brightLight() {

		$koko = exec("cat /sys/class/leds/led1/brightness");

		var_dump($koko);
		die;

		if("is off") {
			exec('echo 1 => /devices/led1');
			return $this->echoGoogle('La lumière est déjà allumée.');
		}

		return $this->echoGoogle('La lumière a été allumée');
	}
}
