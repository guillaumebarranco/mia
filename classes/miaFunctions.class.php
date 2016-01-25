<?php

class MiaFunctions extends Mia {

	public function getRule() {
		return $this->echoGoogle("Je suis régie par les trois lois.");
	}

	public function getHour() {

		$time = date('H:i');

		$time = explode(':', $time);

		if($time[0] < 12) {

			if($time[0] === '00') {
				$hour = 'Minuit et';
			} else {
				$hour = substr($time[0], 1). ' heures';
			}

		} elseif($time[0] === '12') {
			$hour = 'Midi et';
		} else {
			$hour = $time[0].' heures';
		}
		
		if($time[1] < 10) {
			$minutes = substr($time[1], 1). ' minutes';
		} else {
			$minutes = $time[1].' minutes';
		}

		

		return $this->echoGoogle($hour.' et '.$minutes);
	}

	public function getFete() {

		$jour=date("d");
		$mois=date("m");

		$fp=fopen("file:///C:/wamp/www/raspberry/classes/fete.txt","r");

		if($fp) {

			while (!feof($fp)) {

				$ligne=fgets($fp,255);

				$pos=strpos($ligne,';');

				$prenom=substr($ligne,0,$pos);

				$ligne=substr($ligne,$pos+1,strlen($ligne)-$pos);

				$pos=strpos($ligne,';');

				$jourtrouve=substr($ligne,0,$pos);

				$moistrouve=substr($ligne,$pos+1,strlen($ligne)-$pos-2);

				if(($jour == $jourtrouve) && ($mois == $moistrouve)) {

					fclose($fp);
					return " Et c'est la Saint ".$prenom;
				}
			}
		}

		return '';
	}

	public function getTrophies($entry) {
		$cl = curl_init("http://webarranco.fr:3000/PSN/".$entry);

		curl_setopt($cl,CURLOPT_RETURNTRANSFER,true);
		$response = json_decode(curl_exec($cl));

		$responseTrophies = $response->trophySummary->earnedTrophies;

		return $responseTrophies;
	}

	public function getAllTrophiesGuillaume() {
		return $this->echoGoogle("Vous avez ".$this->getTrophies('guillaumanga')->platinum." trophées platines, ".$this->getTrophies('guillaumanga')->gold." trophées d'or, ".$this->getTrophies('guillaumanga')->silver." trophées d'argent et ".$this->getTrophies('guillaumanga')->bronze." trophées de bronze");
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

	public function getTodayDate() {

		

		$date = date('Y-m-d');
		$date = explode('-', $date);

		$year = $date[0];
		$month = $this->transformMonthToString($date[1]);
		$day = $date[2];

		return $this->echoGoogle('Nous sommes le '.$day.' '.$month.' '.$year.$this->getFete());
	}

	public function getTemperature() {

		// 615702 is Paris
		$cl = curl_init("http://weather.yahooapis.com/forecastrss?w=615702&u=f");

		curl_setopt($cl,CURLOPT_RETURNTRANSFER,true);
		$sxe = simplexml_load_string(curl_exec($cl));

		$ns = $sxe->getDocNamespaces();
		$sxe->registerXPathNamespace('yweather',$ns['yweather']);
		$fareinheit = $sxe->xpath("/rss/channel/item/yweather:condition/@temp");

		$celsius = ceil(($fareinheit[0]->temp - 32) / 1.8);

		return $this->echoGoogle('Il fait '.$celsius.' degrés à Paris');
	}

	public function isOpOut() {
		// if page has element with class .episode-table, return true

		$fp=fopen("file:///C:/wamp/www/raspberry/classes/opChapter.txt","r");
		$opChapter=fgets($fp,255);
		fclose($fp);

		$cl = curl_init("http://www.mangapanda.com/one-piece/".$opChapter);

		curl_setopt($cl,CURLOPT_RETURNTRANSFER,true);
		$response = json_encode(curl_exec($cl));

		return stripos($response, "episode-table");
	}

	public function updateOP() {
		$fp=fopen("file:///C:/wamp/www/raspberry/classes/opChapter.txt","r");
		$opChapter=fgets($fp,255);
		fclose($fp);

		$newChapter = intval($opChapter)+1;

		file_put_contents("file:///C:/wamp/www/raspberry/classes/opChapter.txt",$newChapter);
	}

	public function whatDoIDo() {

		$answers = array(
			0 => "Cela fait longtemps que vous n'avez pas lu Kenshin."
		);

		return $this->echoGoogle($this->randomAnswer($answers));
	}

	public function itAngersMe() {

		$answers = array(
			0 => "Que se passe t-il ?"
		);

		return $this->echoGoogle($this->randomAnswer($answers));
	}

}
