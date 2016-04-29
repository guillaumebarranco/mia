<?php

class MiaDatabase extends Mia {
	protected $bdd;

	public function __construct() {

		try {
		    $this->bdd = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
		} catch (Exception $e) {
		    die('Erreur : ' . $e->getMessage());
		}
	}

	public function getCommands() {
		$response = $this->bdd->query("SELECT * FROM commands");
		return $response->fetch();
	}

	public function insertUser($username = '', $password = '') {

		$password = password_hash($password, PASSWORD_BCRYPT);

		try {
			$insert = $this->bdd->prepare("INSERT INTO `users` (`username`, `password`) VALUES (:username, :password)");
			
			$insert->bindParam(':username', $username, \PDO::PARAM_STR);
			$insert->bindParam(':password', $password, \PDO::PARAM_STR);
			$insert->execute();

		} catch (Exception $e) {
			die("Some error occured while the register process : ".$e);
		}
	}

	public function getUser($username = '') {

		$username = ($username === '') ? $_SESSION['username'] : $username;

		// On récupère les utilisateurs enregistrés dans la base de données
		$response = $this->bdd->prepare("SELECT * FROM `users` WHERE `username` = :username");
		$response->bindParam(':username', $username, \PDO::PARAM_STR);
		$response->execute();

		return $response->fetch();
	}
}
