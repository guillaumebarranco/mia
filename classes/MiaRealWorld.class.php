<?php

class MiaRealWorld extends Mia {

	public function brightLight() {

		if("is off") {
			exec('echo 1 => /devices/led1');
			return $this->echoGoogle('La lumière est déjà allumée.');
		}

		return $this->echoGoogle('La lumière a été allumée');
	}
}
