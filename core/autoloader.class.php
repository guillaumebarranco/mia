<?php 

class Autoloader {

	public function __construct() {
		$this->register();
	}

	public function register() {
		spl_autoload_register(function($class) {
			$this->autoload($class);
		});
	}

	public function autoload($class) {
		if(isset($class)) require_once 'classes/'.$class . '.class.php';
	}
}

$autoload = new Autoloader();
