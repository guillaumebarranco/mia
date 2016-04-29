<?php

class MiaDatabase extends Mia {

	public function __construct() {
		try {
		    $bdd = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
		}
		catch (Exception $e) {
		    die('Erreur : ' . $e->getMessage());
		}
	}

	function getCommands() {
		
	}
}
