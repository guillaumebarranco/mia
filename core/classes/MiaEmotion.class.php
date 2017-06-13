<?php

class MiaEmotion extends Mia {

	protected $states = array(
		'happy',
		'angry',
		'sleepy',
		'hungry'
	);

	protected $timeKeepEmotions = 60; // In seconds

	public function __construct() {
		$this->checkEmotions();
	}

	public function initEmotions() {

		$_SESSION['emotions'] = array();

		if(empty($_SESSION['emotions'])) $_SESSION['emotions'] = array();

		$this->setHumor(rand(1,3));
		$this->setState($this->states[rand(1,3)]);
	}

	protected function checkEmotions() {

		if(empty($_SESSION['emotions'])) {
			$this->initEmotions();

		} else if(isset($_SESSION['emotions']) && time() > $_SESSION['emotions']['state_expiration']) {
			$this->initEmotions();
		}
	}

	public function sayHowIFeel() {
		return $this->echoGoogle($this->getState(), 'fr');
	}

	/**
	*	Getters
	*/

	public function getHumor() {

		$this->checkEmotions();

		if(isset($_SESSION['emotions']) && isset($_SESSION['emotions']['humor'])) {
			return $_SESSION['emotions']['humor'];
		} else {
			$this->setHumor(rand(1,3));
			return $this->getHumor();
		}
	}

	public function getState() {

		if(isset($_SESSION['emotions']) && isset($_SESSION['emotions']['state'])) {
			return $_SESSION['emotions']['state'];
		} else {
			$this->setState($this->states[rand(1,3)]);
			return $this->getState();
		}
	}

	/**
	*	Setters
	*/

	public function setHumor($humor) {
		if(is_int($humor)) $_SESSION['emotions']['humor'] = $humor;
	}

	public function setState($state) {

		if(is_string($state)) {
			$_SESSION['emotions']['state'] = $state;
			$_SESSION['emotions']['state_expiration'] = time() + $this->timeKeepEmotions;
		}
	}
}
