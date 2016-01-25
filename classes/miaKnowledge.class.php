<?php

class MiaKnowledge extends Mia {

	public function getFirstLaw() {
		return $this->echoGoogle("Première loi : Un robot ne peut pas faire de mal à un être humain.");
	}

	public function getSecondLaw() {
		return $this->echoGoogle("Seconde loi : Un robot doit obéir à tout ordre qui lui est donné par un humain.");
	}

	public function getThirdLaw() {
		return $this->echoGoogle("Troisième loi : Un robot à le droit de se défendre, tant que cela n'entre pas en collision avec la première ou la seconde loi.");
	}

	public function getThreeLaws() {
		return $this->echoGoogle("Première loi : Un robot ne peut pas faire de mal à un être humain. Seconde loi : Un robot doit obéir à tout ordre qui lui est donné par un humain. Troisième loi : Un robot à le droit de se défendre, tant que cela n'entre pas en collision avec la première ou la seconde loi.");
	}

	public function youAreHere() {

		$ip = getHostByName(getHostName());
		// $ip = '86.198.120.154';

		$city = unserialize((file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip)));

		var_dump($ip);

		var_dump($city);
		die;

		$city = $city['geoplugin_city'];

		$text = ''; 

		if($city === 'Coulommiers') {
			$text = 'Vous êtes chez Ronane';
		} else {
			$text = "Vous êtes dans la ville de ".$city;
		}

		return $this->echoGoogle($text);
	}

	public function RikuFavoriteManga() {
		return $this->echoGoogle("Le manga favori de Kevin est Gintama.");
	}

	public function HikenFavoriteManga() {
		return $this->echoGoogle("Le manga favori de Médrick est Jojo's bizarre adventure.");
	}

	/*
	/
	*/

	public function ownerFavoriteManga() {
		
	}

}