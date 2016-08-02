<?php

// echo "17" > /sys/class/gpio/export
// echo "out" > /sys/class/gpio/gpio17/direction
// cat /sys/class/gpio/gpio17/value
// chmod 777 /sys/class/gpio/gpio17/value
// chown www-data /sys/class/gpio/gpio17/value
// echo 1 > /sys/class/gpio/gpio17/value

class MiaRealWorld extends Mia {

    private $led_path = "/sys/class/gpio/gpio17";

    /*
     *  Managing light
     */

    public function getLightStatus() {

        $read = exec("cat ".$this->led_path."/value");
        return $read;
    }

    public function setLightStatus($value) {
        exec("echo ".$value." > ".$this->led_path."/value");

        if($value === 0) {
            return $this->echoGoogle('La lumière a été allumée');
        }

        return $this->echoGoogle('La lumière a été éteinte');
    }

    /*
     *  Turn ON/OFF light
     */

    public function turnOnLight() {

        if($this->getLightStatus() === "0") {
            return $this->echoGoogle('La lumière est déjà allumée.');
        }

        return $this->setLightStatus(0);
    }

    public function turnOffLight() {

        if($this->getLightStatus() === "1") {
            return $this->echoGoogle('La lumière est déjà éteinte.');
        }

        return $this->setLightStatus(1);
    }

    public function changeLight() {

        if($this->getLightStatus() === 0) {

            return $this->setLightStatus(1);
        }

        return $this->setLightStatus(0);
    }
}
