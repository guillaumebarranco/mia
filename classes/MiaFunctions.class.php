<?php

require_once(getcwd().'/libs/simple_html_dom.php');

class MiaFunctions extends Mia {

	protected $nodePath = 'C:/Users/Guillaume/AppData/Roaming/npm/';

	public function getRule() {
		return $this->echoGoogle("Je suis régie par les trois lois.");
	}

	public function getHour() {

		$time = date('H:i');
		$time = explode(':', $time);

		if($time[0] < 12) {
			$hour = ($time[0] === '00') ? 'Minuit et' : substr($time[0], 1). ' heures';
		} elseif($time[0] === '12') {
			$hour = 'Midi et';
		} else {
			$hour = $time[0].' heures';
		}

		$minutes = ($time[1] < 10) ? substr($time[1], 1). ' minutes' : $time[1].' minutes';		

		return $this->echoGoogle($hour.' et '.$minutes);
	}

	public function getFete() {

		$day = date("d");
		$month = date("m");

		$fp = fopen(getcwd()."/files/fete.txt", "r");

		if($fp) {

			while (!feof($fp)) {

				$line = fgets($fp, 255);

				$pos = strpos($line,';');

				$firstname = substr($line,0,$pos);

				$line = substr($line, $pos+1, strlen($line)-$pos);

				$pos = strpos($line, ';');

				$dayFound = substr($line, 0, $pos);

				$monthFound = substr($line, $pos+1, strlen($line)-$pos-2);

				if(($day == $jourFound) && ($month == $moisFound)) {
					fclose($fp);
					return " Et c'est la Saint ".$firstname;
				}
			}
		}

		return '';
	}

	public function getDay() {
		$jour = array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi');

		return $jour[date('w', time())];
	}

	public function getTodayDate() {

		$date = explode('-', date('Y-m-d')); ;

		$year = $date[0];
		$month = $this->transformMonthToString($date[1]);
		$day = $date[2];

		return $this->echoGoogle('Nous sommes le '.$day.' '.$month.' '.$year.$this->getFete());
	}

	public function getTomorrowTemperature() {

		$cl = curl_init("http://weather.yahooapis.com/forecastrss?w=615702&u=f");

		curl_setopt($cl,CURLOPT_RETURNTRANSFER,true);
		$sxe = simplexml_load_string(curl_exec($cl));

		$ns = $sxe->getDocNamespaces();
		$sxe->registerXPathNamespace('yweather',$ns['yweather']);

		$tomorrow = $sxe->xpath("/rss/channel/item/yweather:forecast");

		$temp_morning = $tomorrow[1]['low'];
		$temp_afternoon = $tomorrow[1]['high'];

		$temp_morning = ceil(($temp_morning - 32) / 1.8);
		$temp_afternoon = ceil(($temp_afternoon - 32) / 1.8);

		return $this->echoGoogle("Il fera en ".$temp_morning." degrés le matin et ".$temp_afternoon." degrés l'après-midi à Paris demain.");
	}

	public function getTemperature() {

		// 615702 is Paris
		$cl = curl_init("http://weather.yahooapis.com/forecastrss?w=615702&u=f");

		curl_setopt($cl,CURLOPT_RETURNTRANSFER,true);
		$sxe = simplexml_load_string(curl_exec($cl));


		$ns = $sxe->getDocNamespaces();
		$sxe->registerXPathNamespace('yweather',$ns['yweather']);

		$fareinheit = $sxe->xpath("/rss/channel/item/yweather:condition/@temp");
		$forecast = $sxe->xpath("/rss/channel/item/yweather:forecast");

		$celsius = ceil(($fareinheit[0]->temp - 32) / 1.8);

		return $this->echoGoogle('Il fait '.$celsius.' degrés à Paris');
	}

	function searchForOp($opOut) {

		if(is_bool($opOut)) {
			$answer = " Le chapitre de One Pice ";
			$answer .= ($opOut) ? "est sorti. " : "n'est pas sorti. ";
		} else {
			$answer = '';
		}

		return $answer;
	}

	function switchDay($day) {

		$opOut = '';

		switch ($day) {

			case 'Lundi':
				$answer = " et c'est le premier jour de la semaine. Courage !";
			break;

			case 'Mardi':
				$answer = " et c'est un bon jour pour aller faire du sport.";
			break;

			case 'Mercredi':
				$answer = ' et vous zavez cours demain.';
				$opOut = $this->isOpOut();
			break;

			case 'Jeudi':
				$answer = " et c'est le week-end demain, enfin !";
				$opOut = $this->isOpOut();
			break;

			case 'Vendredi':
				$answer = " et vous êtes en week-end ce soir, reposez-vous bien !";
			break;

			case 'Samedi':
				$answer = " et nous sommes en week-end, je dors.";
			break;

			case 'Dimanche':
				$answer = " et nous sommes en week-end, je dors.";
			break;
			
			default: break;
		}

		$answer .= $this->searchForOp($opOut);

		return $answer;
	}

	public function colisStatus() {

		$html = file_get_html('http://webtrack.dhlglobalmail.com/?id=12345&trackingnumber=GM575115960082116430');

		foreach($html->find('.card h2') as $element) {
		    $status = trim($element->plaintext);
		}

		$status = preg_replace("/&#?[a-z0-9]{2,8};/i","",$status);

		return $this->echoGoogle("Le status de votre colis est : ".$status);
	}

	public function whatsUp() {

		$answer = '';

		$day = $this->getDay();

		$answer .= "Nous sommes ".$day;
		$answer .= $this->switchDay($day);	

		$answer .= $this->shortenGoogle($this->getTemperature());
		$answer .= " et ";

		$answer .= $this->shortenGoogle($this->pingServer());

		return $this->echoGoogle($answer);
	}

	function getGithubAccount($wanted = 'repositories') {

		if($wanted === 'repositories') {

			$html = file_get_html('https://github.com/guillaumebarranco?tab=repositories');

			$i = 0;
			foreach($html->find('.repo-list-name') as $element) {
			    $i++;
			}

			$response = $i;

		} elseif($wanted === 'commits') {

			$html = file_get_html('https://github.com/guillaumebarranco');

			$response = $html->find('.contrib-column-first .contrib-number')[0]->plaintext;
			$response = intval(substr($response, 0, -7));
		}

		return $response;
	}

	public function getCommits() {
		$repositories = $this->getGithubAccount('repositories');
		$commits = $this->getGithubAccount('commits');

		return $this->echoGoogle("Vous avez à votre actif ".$repositories." repositories et $commits commits");
	}

	public function getTV() {

		$html = file_get_html('http://www.programme-tv.net/programme/programme-tnt.html');

		$response = $html->find('.channel');

		$answer = '';

		foreach ($response as $channel) {
			
			$title = $channel->children[0]->children[0]->attr['title'];

			$array_chaines = array('TF1', 'M6', 'W9', 'Canal+');

			if(in_array(substr($title, 13), $array_chaines)) {
				$movie = $channel->children[1]->children[1]->children[2]->attr['title'];
				$answer .= $title.' : '.$movie.'. ';
			}
		}

		return $this->echoGoogle($answer);
	}

	public function isOpOut() {

		$fp = fopen(getcwd()."/files/opChapter.txt", "r");
		$opChapter = fgets($fp, 255);
		fclose($fp);

		$cl = curl_init("http://www.mangapanda.com/one-piece/".$opChapter);

		curl_setopt($cl,CURLOPT_RETURNTRANSFER,true);
		$response = json_encode(curl_exec($cl));

		$boolean = stripos($response, "episode-table");

		if($boolean) $this->updateOP();

		return $boolean;
	}

	function updateOP() {
		$fp = fopen(getcwd()."/files/opChapter.txt", "r");
		$opChapter = fgets($fp, 255);
		fclose($fp);

		$newChapter = intval($opChapter) + 1;

		file_put_contents("file:///C:/wamp/www/mia/files/opChapter.txt",$newChapter);
	}

	public function youAreHere() {

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "http://ip-api.com/php");
		curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
		$content = curl_exec ($curl);
		curl_close ($curl); 

		$ip = (unserialize($content));
		$ip = $ip['query'];

		$city = unserialize((file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip)));


		$city = $city['geoplugin_city'];

		$text = ''; 

		if($city === 'Coulommiers') {
			$text = 'Vous êtes chez Ronane';
		} elseif($city === 'Paris') {
			$text = "Vous êtes à Paris, probablement à Weblib ou bien à votre école.";
		} else {
			$text = "Vous êtes dans la ville de ".$city;
		}

		return $this->echoGoogle($text);
	}

	public function pingServer() {

		$ip_server = "92.222.34.194";

	    $pingresult = exec("ping $ip_server", $outcome, $status);

	    $status = ($status === 0) ? 'vivant' : 'mort';

	    return $this->echoGoogle('Votre serveur est '.$status);
	}

	/*
	*	Trophies API PSN
	*/

	function getTrophies($entry) {
		$cl = curl_init("http://webarranco.fr:3000/PSN/".$entry);

		curl_setopt($cl,CURLOPT_RETURNTRANSFER,true);
		$response = json_decode(curl_exec($cl));

		if(!empty($response) && isset($response->trophySummary)) {
			$responseTrophies = $response->trophySummary->earnedTrophies;
			return $responseTrophies;
		}

		return $this->echoGoogle('Votre A P I P S N ne répond pas.');
	}

	public function getAllTrophiesGuillaume() {
		$test = $this->getTrophies('guillaumanga');

		if(is_object($test)) {

			return $this->echoGoogle("Vous avez ".$this->getTrophies('guillaumanga')->platinum." trophées platines, ".$this->getTrophies('guillaumanga')->gold." trophées d'or, ".$this->getTrophies('guillaumanga')->silver." trophées d'argent et ".$this->getTrophies('guillaumanga')->bronze." trophées de bronze");
		}

		return $test;
	}

	public function getAllTrophiesRonan() {
		return $this->echoGoogle("Il a ".$this->getTrophies('R0n4N7710')->platinum." trophées platines, ".$this->getTrophies('R0n4N7710')->gold." trophées d'or, ".$this->getTrophies('R0n4N7710')->silver." trophées d'argent et ".$this->getTrophies('R0n4N7710')->bronze." trophées de bronze");
	}

	public function getPlatine() {
		return $this->echoGoogle('Vous avez '.$this->getTrophies()->platinum.' trophées platines');
	}

	public function getOr() {
		return $this->echoGoogle("Vous avez ".$this->getTrophies()->gold." trophées d'or");
	}

	public function getArgent() {
		return $this->echoGoogle("Vous avez ".$this->getTrophies()->silver." trophées d'argent");
	}

	public function getBronze() {
		return $this->echoGoogle("Vous avez ".$this->getTrophies()->bronze." trophées de bronze");
	}

	/*
	*	Artificial Intelligence
	*/

	public function searchGoogle($question) {

		// $search_website = file_get_html('http://google.fr/#q='.$question);
		$search_website = file_get_html('https://www.google.fr/?q=combien+y%27a+t-il+de+lunes+m');

		foreach ($search_website->find('div') as $koko) {
			// var_dump($koko->find('div')[0]->find('div')[0]->find('div')[0]->find('div')[0]->plaintext);
			var_dump($koko->plaintext);
		}
			die;

		$first_website = $search_website->find('.g')[0];

		// $html = file_get_html($first_website);

		var_dump($first_website);
		die;

		return $this->echoGoogle("Voici la réponse");
	}

	public function how2() {

		$pingresult = exec("C:/Users/Guillaume/AppData/Roaming/npm/how2 make object -l javascript", $output, $status);

		var_dump($output);
		var_dump($status);
		die;
	}

	public function caniuse($command) {

		$command = substr($command, 8);

		$pingresult = exec($this->nodePath."/caniuse ".$command, $output, $status);

		$tab_response = array();
		$tab_engines = array(
			" IE",
			" Edge",
			" Firefox",
			" Chrome",
			" Safari"
		);

		foreach ($output as $response) {
			foreach ($tab_engines as $engine) {
				if(strstr($response, $engine, true)) {
					$tab_response[trim($engine)] = trim($response);
				}
			}
		}

		$tab_response2 = array();

		foreach ($tab_response as $key => $response) {
			$regex = '/[Ã]/';

			$matches = array();

			if (preg_match($regex, $tab_response[$key], $matches)) {
			    $tab_response2[$key] = $response;
			}
		}

		$return = '';

		foreach ($tab_response2 as $key => $response) {

			$regex = '/√ (\d.+)/';

			$matches = array();

			$version = '';

			if (preg_match($regex, $tab_response2[$key], $matches)) {
				$version = array_pop($matches);
				$return .= $key.' : supporté à partir de la version '.$version.'. ';
			}
		}

		if($return === '') $return = 'Oui !';

		return $this->echoGoogle($return);
	}
}
