<?php

class MiaPrivate extends Mia {
	// case "myFavoriteManga": $text = $miaPrivate->myFavoriteManga(); break;
	// 			case "hikenFavoriteManga": $text = $miaPrivate->HikenFavoriteManga(); break;
	// 			case "whatCWant": $text = $miaPrivate->whatCWant(); break;
	// 			case "codeMoney": $text = $miaPrivate->codeMoney(); break;

	// 			case "annivNathan": $text = $miaPrivate->annivNathan(); break;

	// 			case "annivAelys": $text = $miaPrivate->annivAelys(); break;
	// 			case "annivSoon": $text = $miaPrivate->annivSoon(); break;

	// 			case "beLikeC": $text = $miaPrivate->beLikeC(); break;

	public function codeMoney() {
		return $this->echoGoogle("Votre code a été copié dans la console. 3080350098298");
	}

	public function annivSoon() {

		$annivs = array(
			'07-02' => 'Nathan',
			'30-07' => 'Aelys',
			'10-10' => 'Maman',
			'22-10' => 'Papa'
		);

		$day = date('d');
		$month = date('m');

		$anniv = '';

		for ($i=0; $i < 365; $i++) {

			if($anniv === '' && isset($annivs[$day.'-'.$month])) {
				$anniv = $annivs[$day.'-'.$month];
				break;
			}

			$day = intval($day);
			$day++;

			if($day < 10) $day = '0'.$day;

			if(intval($day > 30)) {
				$month = intval($month);
				$month++;
				$day = '01';
			}

			if(intval($month < 10)) $month = '0'.intval($month);
		}

		return $this->echoGoogle("L'anniversaire le plus proche est celui de ".$anniv);
	}
}
