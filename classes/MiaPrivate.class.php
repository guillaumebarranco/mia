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
}
