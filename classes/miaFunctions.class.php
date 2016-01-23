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

		$fp=fopen("../fete.txt","r");

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
				return $this->echoGoogle("C'est la Saint ".$prenom);
			}
		}

		fclose($fp);
		return '';
	}

	public function getTrophies() {
		$cl = curl_init("http://webarranco.fr:3000/PSN/guillaumanga");

		curl_setopt($cl,CURLOPT_RETURNTRANSFER,true);
		$response = json_decode(curl_exec($cl));

		$responseTrophies = $response->trophySummary->earnedTrophies;

		return $responseTrophies;
	}

	public function getAllTrophies() {
		return $this->echoGoogle("Vous avez ".$this->getTrophies()->platinum." trophées platines, ".$this->getTrophies()->gold." trophées d'or, ".$this->getTrophies()->silver." trophées d'argent et ".$this->getTrophies()->bronze." trophées de bronze");
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

		return $this->echoGoogle('Le '.$day.' '.$month.' '.$year);
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

}
