<?php
	
	$text = '';

	if(isset($_GET['text']) && $_GET['text'] !== '') {

		require_once('classes/mia.class.php');
		require_once('classes/miaHumour.class.php');
		require_once('classes/miaKnowledge.class.php');
		require_once('classes/miaFunctions.class.php');

		$mia = new Mia();
		$miaHumour = new MiaHumour();
		$miaKnowledge = new MiaKnowledge();
		$miaFunctions = new MiaFunctions();

		switch($_GET['text']) {

			case "hour":
				$text = $miaFunctions->getHour();
			break;

			case "date":
				$text = $miaFunctions->getTodayDate();
			break;

			case "temperature":
				$text = $miaFunctions->getTemperature();
			break;

			case "fete":
				$text = $miaFunctions->getFete();
			break;

			case "platine":
				$text = $miaFunctions->getPlatine();
			break;

			case "or":
				$text = $miaFunctions->getOr();
			break;

			case "argent":
				$text = $miaFunctions->getArgent();
			break;

			case "bronze":
				$text = $miaFunctions->getBronze();
			break;

			case "guillaume_trophies":
				$text = $miaFunctions->getAllTrophiesGuillaume();
			break;

			case "ronan_trophies":
				$text = $miaFunctions->getAllTrophiesRonan();
			break;

			case "name":
				$text = $mia->sayName();
			break;

			case "robot":
				$text = $mia->sayFunction();
			break;

			case "rule":
				$text = $miaFunctions->getRule();
			break;

			case "first_law":
				$text = $miaKnowledge->getFirstLaw();
			break;

			case "second_law":
				$text = $miaKnowledge->getSecondLaw();
			break;

			case "third_law":
				$text = $miaKnowledge->getThirdLaw();
			break;

			case "laws":
				$text = $miaKnowledge->getThreeLaws();
			break;

			case "age":
				$text = $miaHumour->getAge();
			break;

			case "wantAJoke":
				$text = $mia->sayNoThanks();
			break;

			case "areYouFine":
				$text = $mia->sayYes();
			break;

			case "hello":
				$text = $mia->sayHello();
			break;

			case "wellFine":
				$text = $mia->sayAlright();
			break;

			case "wellAndYou":
				$text = $mia->sayItsOk();
			break;

			case "bemol":
				$text = $mia->sayAlright();
			break;

			case "goodNight":
				$text = $mia->sayGoodNightToo();
			break;

			case "goToSleep":
				$text = $mia->sayGoodNight();
			break;

			case "isOpOut":
				$op_status = $miaFunctions->isOpOut();

				if($op_status) {
					$text = $mia->sayYes();
				} else {
					$text = $mia->sayNo();
				}

			break;

			case "areYouAlive":
				$text = $miaHumour->areYouAlive();
			break;

			case "amIFunny":
				$text = $mia->sayOfCourse();
			break;

			case "whatAreYouDoing":
				$text = $miaHumour->sayWhatYouDo();
			break;

			case "howAreYou":
				$text = $miaHumour->sayGreat();
			break;

			case "didYouSleepWell":
				$text = $mia->sayItsOk();
			break;

			case "didYouHaveNiceDreams":
				$text = $mia->sayGreatAndYou();
			break;

			case "favoriteFood":
				$text = $mia->favoriteFood();
			break;

			case "comePlayWithUs":
				$text = $miaHumour->comePlayWithUs();
			break;

			case "doesntWork":
				$text = $mia->sayWhatHappened();
			break;

			case "iAmHungry":
				$text = $miaHumour->haveYouAMomentNotEat();
			break;

			case "whereAmI":
				$text = $miaKnowledge->youAreHere();
			break;

			case "weGo":
				$text = $mia->sayWhereYouGo();
			break;

			case "yourModel":
				$text = $mia->model();
			break;

			case "yourLover":
				$text = $mia->lover();
			break;

			case "isHeAware":
				$text = $mia->isHeAware();
			break;

			case "iMGoing":
				$text = $mia->sayBeCarefulOnTheRoad();
			break;

			case "hikenFavoriteManga":
				$text = $miaKnowledge->HikenFavoriteManga();
			break;



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

	if(isset($_GET) && !empty($_GET)) {

		echo $text;

		// echo '<iframe style="opacity:1;" src="'.$text.'" autoplay></iframe>';
		// echo '<a href="http://localhost/raspberry/functions.php">Retour</a>';
	} else {
		echo 'Just say something';
	}

	//exec('mpg321 '.urlencode($text));
