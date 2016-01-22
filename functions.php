<?php
	
	$text = '';

	define('GOOGLE', "http://translate.google.com/translate_tts?tl=fr&client=tw-ob&q=");

	$get_texts = [
		'hour',
		'date',
		'temperature',
		'fete',
		'platine',
		'or',
		'argent',
		'bronze'
	];

	function echoGoogle($content) {
		return GOOGLE.urlencode($content);
	}

	function getTrophies() {
		$cl = curl_init("http://webarranco.fr:3000/PSN/guillaumanga");

		curl_setopt($cl,CURLOPT_RETURNTRANSFER,true);
		$response = json_decode(curl_exec($cl));

		$responseTrophies = $response->trophySummary->earnedTrophies;

		return $responseTrophies;
	}

	function getPlatine() {
		return echoGoogle('Vous avez '.getTrophies()->platinum.' trophées platines');
	}

	function getOr() {
		return echoGoogle("Vous avez ".getTrophies()->gold." trophées d'or");
	}

	function getArgent() {
		return echoGoogle("Vous avez ".getTrophies()->silver." trophées d'or");
	}

	function getBronze() {
		return echoGoogle("Vous avez ".getTrophies()->bronze." trophées d'or");
	}

	function getHour() {

		$time = date('H:i');

		$time = explode(':', $time); 

		$hour = $time[0].' heures';
		$minutes = $time[1].' minutes';

		return echoGoogle($hour.' et '.$minutes);
	}

	function getTodayDate() {

		$months = array(
			'01' => "Janvier",
			'02' => "Février",
			'03' => "Mars",
			'04' => "Avril",
			'05' => "Mai",
			'06' => "Juin",
			'07' => "Juillet",
			'08' => "Aout",
			'09' => "Septembre",
			'10' => "Octobre",
			'11' => "Novembre",
			'12' => "Décembre"
		);

		$date = date('Y-m-d');
		$date = explode('-', $date);

		$year = $date[0];
		$month = $months[$date[1]];
		$day = $date[2];

		return echoGoogle('Le '.$day.' '.$month.' '.$year);
	}

	function getTemperature() {

		// 615702 is Paris
		$cl = curl_init("http://weather.yahooapis.com/forecastrss?w=615702&u=f");

		curl_setopt($cl,CURLOPT_RETURNTRANSFER,true);
		$sxe = simplexml_load_string(curl_exec($cl));

		$ns = $sxe->getDocNamespaces();
		$sxe->registerXPathNamespace('yweather',$ns['yweather']);
		$fareinheit = $sxe->xpath("/rss/channel/item/yweather:condition/@temp");

		$celsius = ceil(($fareinheit[0]->temp - 32) / 1.8);

		return echoGoogle('Il fait '.$celsius.' degrés à Paris');
	}

	function getFete() {

		$jour=date("d");
		$mois=date("m");

		$fp=fopen("fete.txt","r");

		while (!feof($fp)) {

			$ligne=fgets($fp,255);

			$pos=strpos($ligne,';');

			$prenom=substr($ligne,0,$pos);

			$ligne=substr($ligne,$pos+1,strlen($ligne)-$pos);

			$pos=strpos($ligne,';');

			$jourtrouve=substr($ligne,0,$pos);

			$moistrouve=substr($ligne,$pos+1,strlen($ligne)-$pos-2);

			if (($jour==$jourtrouve) && ($mois==$moistrouve)) {

				fclose($fp);
				return echoGoogle("C'est la Saint ".$prenom);
			}
		}

		fclose($fp);
		return '';
	}

	if(isset($_GET['text']) && $_GET['text'] !== '') {

		if(in_array($_GET['text'], $get_texts)) {

			switch($_GET['text']) {

				case "hour":
					$text = getHour();
				break;

				case "date":
					$text = getTodayDate();
				break;

				case "temperature":
					$text = getTemperature();
				break;

				case "fete":
					$text = getFete();
				break;

				case "platine":
					$text = getPlatine();
				break;

				case "or":
					$text = getOr();
				break;

				case "argent":
					$text = getArgent();
				break;

				case "bronze":
					$text = getBronze();
				break;

				default:
				break;
			}

		} else {

			$text = $_GET['text'];
			$text = 'http://translate.google.com/translate_tts?tl=fr&client=tw-ob&q='.$text;
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

	var_dump($text);

	//exec('mpg321 '.urlencode($text));
	
?>
