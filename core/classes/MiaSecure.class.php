<?php

class MiaSecure extends Mia {
		// case "myFavoriteManga": $text = $miaPrivate->myFavoriteManga(); break;
	// 			case "hikenFavoriteManga": $text = $miaPrivate->HikenFavoriteManga(); break;
	// 			case "whatCWant": $text = $miaPrivate->whatCWant(); break;
	// 			case "codeMoney": $text = $miaPrivate->codeMoney(); break;
	// 			case "annivNathan": $text = $miaPrivate->annivNathan(); break;
	// 			case "annivAelys": $text = $miaPrivate->annivAelys(); break;
	// 			case "annivSoon": $text = $miaPrivate->annivSoon(); break;
	// 			case "beLikeC": $text = $miaPrivate->beLikeC(); break;

	public function HikenFavoriteManga() {
		return $this->echoGoogle("Le manga favori d'Hiken est Jojo's Bizarre Adventure");
	}

	public function RikuFavoriteManga() {
		return $this->echoGoogle("Le manga favori de Riku est Gintama");
	}

	public function PeroFavoriteManga() {
		return $this->echoGoogle("Le manga favori de Pero est Puella Magi Madoka Magica");
	}

	public function MyFavoriteManga() {
		return $this->echoGoogle("Votre manga préféré est One Pice");
	}


	public function codeMoney() {
		return $this->echoGoogle("Votre code a été copié dans la console. 3080350098298");
	}

	function getAllAnnivs() {

		return array(
			'07-02' => 'Nathan',
			'17-05' => 'Aurelien',
			'30-07' => 'Aelys',
			'31-08' => 'Angeline',
			'10-10' => 'Maman',
			'22-10' => 'Papa'
		);
	}

	public function annivSoon() {

		$annivs = $this->getAllAnnivs();

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
