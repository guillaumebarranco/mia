<?php

	header("Access-Control-Allow-Origin: *");

	require_once 'core/autoloader.class.php';
	require_once 'config.php';

	require_once __DIR__.'/core/libs/simple_html_dom.php';

	$mia 			= new Mia();
	$miaHumour 		= new MiaHumour();
	$miaKnowledge 	= new MiaKnowledge();
	$miaFunctions 	= new MiaFunctions();
	$miaPage 		= new MiaPage();
	$miaSecure 		= new MiaSecure();
	$miaRealWorld 	= new MiaRealWorld();
	$miaDatabase 	= new MiaDatabase();
	
	$text = '';

	function switchText($textEntry) {

		$text = '';

		global $mia;
		global $miaHumour;
		global $miaKnowledge;
		global $miaFunctions;
		global $miaSecure;
		global $miaRealWorld;
		global $miaDatabase;

		switch($textEntry) {

			//	Basics

				case "hello": $text = $mia->sayHello(); break;
				case "youAreRight": $text = $mia->sayOfCourse(); break;
			
			//	About Mia

				case "name": $text = $mia->sayName(); break;
				case "robot": $text = $mia->sayFunction(); break;

				case "whoAreYou": $text = $mia->whoIAm(); break;

				case "rule": $text = $miaFunctions->getRule(); break;
				case "age": $text = $miaHumour->getAge(); break;

				case "areYouAlive": $text = $miaHumour->areYouAlive(); break;
				case "whatAreYouDoing": $text = $miaHumour->sayWhatYouDo(); break;

				case "howAreYou": $text = $miaHumour->sayGreat(); break;
				case "didYouSleepWell": $text = $mia->sayItsOk(); break;

				case "didYouHaveNiceDreams": $text = $mia->sayGreatAndYou(); break;
				case "favoriteFood": $text = $mia->favoriteFood(); break;
				case "yourModel": $text = $mia->model(); break;

				case "yourLover": $text = $mia->lover(); break;

				case "isHeAware": $text = $mia->isHeAware(); break;

				case "whatYouHate": $text = $mia->whatYouHate(); break;
				case "whatYouLike": $text = $mia->whatYouLike(); break;

				case "imProudOfYou": $text = $mia->sayImProudOfYouToo(); break;

			//	Custom
			
				case 'whatDoIDo': 				$text = $miaKnowledge->whatDoIDo(); 				break;
				case 'itAngersMe': 				$text = $miaFunctions->itAngersMe(); 				break;
				case 'thankYou': 				$text = $mia->sayNoProblem(); 						break;
				case 'counselMeAManga': 		$text = $miaKnowledge->counselMeAManga(); 			break;

			//	Informations

				case "isOpOut":
					$op_status = $miaFunctions->isOpOut();
					$text = ($op_status) ? $mia->sayYes() : $mia->sayNo();
				break;

				case "colisStatus":				$text = $miaFunctions->colisStatus();				break;
				case "whatsUp":					$text = $miaFunctions->whatsUp();					break;

				case 'test': 					$text = $mia->sayTest(); 							break;

				case "hour": 					$text = $miaFunctions->getHour(); 					break;
				case "date": 					$text = $miaFunctions->getTodayDate(); 				break;
				case "temperature": 			$text = $miaFunctions->getTemperature(); 			break;
				case "temperature_tomorrow": 	$text = $miaFunctions->getTomorrowTemperature(); 	break;
				case "fete": 					$text = $miaFunctions->getFete(); 					break;

				case "platine": 				$text = $miaFunctions->getPlatine(); 				break;
				case "or": 						$text = $miaFunctions->getOr(); 					break;
				case "argent": 					$text = $miaFunctions->getArgent(); 				break;
				case "bronze": 					$text = $miaFunctions->getBronze(); 				break;

				case "commits": 				$text = $miaFunctions->getCommits(); 				break;

				case "guillaume_trophies": 		$text = $miaFunctions->getAllTrophiesGuillaume(); 	break;
				case "ronan_trophies": 			$text = $miaFunctions->getAllTrophiesRonan(); 		break;

				case "first_law": 				$text = $miaKnowledge->getFirstLaw(); 				break;
				case "second_law": 				$text = $miaKnowledge->getSecondLaw(); 				break;
				case "third_law": 				$text = $miaKnowledge->getThirdLaw(); 				break;
				case "laws": 					$text = $miaKnowledge->getThreeLaws(); 				break;

				case "myServerState": 			$text = $miaFunctions->pingServer(); 				break;
				case "getTV": 					$text = $miaFunctions->getTV(); 					break;

				case "news": 					$text = $miaKnowledge->getNews(); 					break;

			//	Private

				case "myFavoriteManga": 		$text = $miaSecure->myFavoriteManga(); 				break;
				case "hikenFavoriteManga": 		$text = $miaSecure->HikenFavoriteManga(); 			break;
				case "rikuFavoriteManga": 		$text = $miaSecure->RikuFavoriteManga();			break;
				case "peroFavoriteManga": 		$text = $miaSecure->PeroFavoriteManga();			break;
				case "whatCWant": 				$text = $miaSecure->whatCWant(); 					break;
				case "codeMoney": 				$text = $miaSecure->codeMoney(); 					break;
				case "beLikeC": 				$text = $miaSecure->beLikeC(); 						break;

				case "annivNathan": 			$text = $miaSecure->annivNathan(); 					break;
				case "annivAelys": 				$text = $miaSecure->annivAelys(); 					break;
				case "annivSoon": 				$text = $miaSecure->annivSoon(); 					break;				

			//	Hehe

				case "whoIsTheHero": 			$text = $mia->sayWhoIsTheHero(); 					break;
				case "whoIsTheKing": 			$text = $mia->sayWhoIsTheKing(); 					break;
				case "whoShotFirst": 			$text = $mia->sayWhoShotFirst(); 					break;
				case "whoIsTheFastestManAlive": $text = $mia->sayWhoIsTheFastest(); 				break;

			//	All commands

				case "wantAJoke": 				$text = $mia->sayNoThanks(); 						break;
				case "areYouFine": 				$text = $mia->sayYes(); 							break;
				case "wellFine": 				$text = $mia->sayAlright(); 						break;
				case "wellAndYou":				$text = $mia->sayItsOk(); 							break;

				case "sayHelloToNico": 			$text = $mia->sayHelloToNico(); 					break;

				case "bemol": 					$text = $mia->sayAlright(); 						break;

				case "goodNight": 				$text = $mia->sayGoodNightToo(); 					break;
				case "goToSleep": 				$text = $mia->sayGoodNight(); 						break;

				case "amIFunny": 				$text = $mia->sayOfCourse(); 						break;
				case "helloCass": 				$text = $mia->sayHelloCass(); 						break;
				case "comePlayWithUs": 			$text = $miaHumour->comePlayWithUs(); 				break;
				case "doesntWork": 				$text = $mia->sayWhatHappened(); 					break;
				case "iAmHungry": 				$text = $miaHumour->haveYouAMomentNotEat(); 		break;
				case "whereAmI": 				$text = $miaFunctions->youAreHere(); 				break;
				case "weGo": 					$text = $mia->sayWhereYouGo(); 						break;
				case "iMGoing": 				$text = $mia->sayBeCarefulOnTheRoad(); 				break;
				case "iLoveYou": 				$text = $mia->sayIKnow();							break;

			//	Real World

				case "turnOnLight": 			$text = $miaRealWorld->turnOnLight(); 				break;
				case "turnOffLight": 			$text = $miaRealWorld->turnOffLight(); 				break;

			//	Code

				case "how2": 					$text = $miaFunctions->how2(); 						break;

			//	Database
				case "getCommands": 			$text = $miaDatabase->getCommands(); 				break;
		}

		return $text;
	}

	function switchPage($entry) {

		global $miaPage;

		switch ($entry) {
			case "meteo": 				$datas = $miaPage->getTemperaturePage(); 			break;
			case "tv":					$datas = $miaPage->getTVPage();						break;
		}

		echo json_encode($datas);
	}

	function answerText($text) {

		if(IS_RASPBERRY === true) {
			exec('mpg321 "'.$text.'"');

		} else {

			if(isset($_GET) && !empty($_GET)) {

				if(isset($_GET['source']) && $_GET['source'] === 'js') {

					$array = array(
						"text" => $text
					);
					echo json_encode($array);

				} else {
					echo '<iframe style="opacity:1;" src="'.$text.'" autoplay></iframe>';
					echo '<a href="http://localhost/raspberry/functions.php">Retour</a>';
				}
			}
		}
	}

	if(isset($_GET['page']) && $_GET['page'] !== '') return switchPage($_GET['page']);

	if(isset($_GET['text']) && $_GET['text'] !== '') {

		$text = switchText($_GET['text']);

		if($text === '') {

			if(substr($_GET['text'],0,7) === 'caniuse') {
				$text = $miaFunctions->caniuse($_GET['text']);
			}
		}

		if($text === '') $text = $mia->echoGoogle("Cette commande n'existe pas dans mon programme.");

		answerText($text);
	}

	if(isset($_GET['action']) && $_GET['action'] === 'searchGoogle') {

		$response = $miaFunctions->searchGoogle($_GET['question']);

		var_dump($response);
		die;
	}
