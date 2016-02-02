<?php

	require_once('classes/autoloader.class.php');
	require_once('config.php');
	
	$text = '';

	if(isset($_GET['text']) && $_GET['text'] !== '') {

		$mia = new Mia();
		$miaHumour = new MiaHumour();
		$miaKnowledge = new MiaKnowledge();
		$miaFunctions = new MiaFunctions();
		$miaPrivate = new MiaPrivate();

		switch($_GET['text']) {

			//	Basics

				case "hello": $text = $mia->sayHello(); break;
			
			//	About Mia

				case "name": $text = $mia->sayName(); break;
				case "robot": $text = $mia->sayFunction(); break;
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

			//	Custom
			
				case 'whatDoIDo': $text = $miaFunctions->whatDoIDo(); break;
				case 'itAngersMe': $text = $miaFunctions->itAngersMe(); break;
				case 'thankYou': $text = $mia->sayNoProblem(); break;

			//	Informations

				case "isOpOut":
					$op_status = $miaFunctions->isOpOut();
					$text = ($op_status) ? $mia->sayYes() : $mia->sayNo();
				break;

				case "colisStatus":
					$text = $miaFunctions->colisStatus();
				break;

				case "whatsUp":
					$text = $miaFunctions->whatsUp();
				break;

				case 'test': $text = $mia->sayTest(); break;

				case "hour": $text = $miaFunctions->getHour(); break;
				case "date": $text = $miaFunctions->getTodayDate(); break;
				case "temperature": $text = $miaFunctions->getTemperature(); break;
				case "fete": $text = $miaFunctions->getFete(); break;

				case "platine": $text = $miaFunctions->getPlatine(); break;
				case "or": $text = $miaFunctions->getOr(); break;
				case "argent": $text = $miaFunctions->getArgent(); break;
				case "bronze": $text = $miaFunctions->getBronze(); break;

				case "commits": $text = $miaFunctions->getCommits(); break;

				case "guillaume_trophies": $text = $miaFunctions->getAllTrophiesGuillaume(); break;
				case "ronan_trophies": $text = $miaFunctions->getAllTrophiesRonan(); break;

				case "first_law": $text = $miaKnowledge->getFirstLaw(); break;
				case "second_law": $text = $miaKnowledge->getSecondLaw(); break;
				case "third_law": $text = $miaKnowledge->getThirdLaw(); break;
				case "laws": $text = $miaKnowledge->getThreeLaws(); break;

				case "myServerState": $text = $miaFunctions->pingServer(); break;
				case "getTV": $text = $miaFunctions->getTV(); break;

			//	Private

				case "myFavoriteManga": $text = $miaPrivate->myFavoriteManga(); break;
				case "hikenFavoriteManga": $text = $miaPrivate->HikenFavoriteManga(); break;
				case "whatCWant": $text = $miaPrivate->whatCWant(); break;
				case "codeMoney": $text = $miaPrivate->codeMoney(); break;

				case "annivNathan": $text = $miaPrivate->annivNathan(); break;

				case "annivAelys": $text = $miaPrivate->annivAelys(); break;
				case "annivSoon": $text = $miaPrivate->annivSoon(); break;

				case "beLikeC": $text = $miaPrivate->beLikeC(); break;

			//	Hehe

				case "whoIsTheHero": $text = $mia->sayWhoIsTheHero(); break;
				case "whoIsTheKing": $text = $mia->sayWhoIsTheKing(); break;
				case "whoShotFirst": $text = $mia->sayWhoShotFirst(); break;
				case "whoIsTheFastestManAlive": $text = $mia->sayWhoIsTheFastest(); break;

			//	All commands

				case "wantAJoke": $text = $mia->sayNoThanks(); break;
				case "areYouFine": $text = $mia->sayYes(); break;

				case "wellFine": $text = $mia->sayAlright(); break;

				case "wellAndYou": $text = $mia->sayItsOk(); break;

				case "bemol": $text = $mia->sayAlright(); break;

				case "goodNight": $text = $mia->sayGoodNightToo(); break;

				case "goToSleep": $text = $mia->sayGoodNight(); break;

				case "amIFunny": $text = $mia->sayOfCourse(); break;
				case "helloCass": $text = $mia->sayHelloCass(); break;
				case "comePlayWithUs": $text = $miaHumour->comePlayWithUs(); break;
				case "doesntWork": $text = $mia->sayWhatHappened(); break;
				case "iAmHungry": $text = $miaHumour->haveYouAMomentNotEat(); break;
				case "whereAmI": $text = $miaFunctions->youAreHere(); break;
				case "weGo": $text = $mia->sayWhereYouGo(); break;
				case "iMGoing": $text = $mia->sayBeCarefulOnTheRoad(); break;

			default:
				$text = $mia->echoGoogle("Cette commande n'existe pas dans mon programme.");
			break;
		}

	}

	if(isset($_POST['text']) && $_POST['text'] !== '') {

		switch($_POST['text']) {

			case "timmy":
				$text = 'http://son.com/timmy.mp3';
			break;

			default:
			break;
		}

	}

	// var_dump($text);

	if(IS_RASPBERRY === true) {
		exec('mpg321 "'.$text.'"');
	} else {

		if(isset($_GET) && !empty($_GET)) {

			if(isset($_GET['source']) && $_GET['source'] === 'js') {
				echo $text;
			} else {
				echo '<iframe style="opacity:1;" src="'.$text.'" autoplay></iframe>';
				echo '<a href="http://localhost/raspberry/functions.php">Retour</a>';
			}

		} else {
			echo 'Just say something';
		}
	}
