<?php

/*class MiaRealWorld extends Mia {

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
}*/


//echo "17" > /sys/class/gpio/export
//echo "out" > /sys/class/gpio/gpio17/direction
//cat /sys/class/gpio/gpio17/value
//chmod 777 /sys/class/gpio/gpio17/value
//chown www-data /sys/class/gpio/gpio17/value
class MiaRealWorld extends Mia {

    private $led_path = "/sys/class/leds/led1";

    public function turnOnLight() {

            $koko = exec("cat ".$this->led_path."/brightness");

            if($koko === "255") {
                return $this->echoGoogle('La lumière est déjà allumée.');
            }

            $koko = exec("echo 255 > ".$this->led_path."/brightness");

            exec("echo 0 > /sys/class/gpio/gpio17/value");
            return $this->echoGoogle('La lumière a été allumée');
    }

    public function turnOffLight() {

            $koko = exec("cat ".$this->led_path."/brightness");

            if($koko === "0") {
                    return $this->echoGoogle('La lumière est déjà éteinte.');
            }

            $koko = exec("echo 0 > ".$this->led_path."/brightness");

            exec("echo 1 > /sys/class/gpio/gpio17/value");
            return $this->echoGoogle('La lumière a été éteinte');
    }
}
