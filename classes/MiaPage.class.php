<?php

require_once(getcwd().'/libs/simple_html_dom.php');

class MiaPage extends Mia {

	public function getTemperaturePage() {

		$apikey = "aa870edae9ce0abe6b9751aa67743a71";

		// 6455259 is Paris
		$cl = curl_init("http://api.openweathermap.org/data/2.5/weather?id=6455259&units=metric&appid=".$apikey);
		curl_setopt($cl,CURLOPT_RETURNTRANSFER,true);
		$result = json_decode(curl_exec($cl));

		$celsius = round($result->main->temp);

		$datas = array(
			"temp" => $celsius,
			"state" => $result
		);

		return $datas;
	}

	public function getTVPage() {

		$html = file_get_html('http://www.programme-tv.net/programme/programme-tnt.html');

		$response = $html->find('.channel');

		$answer = '';

		$stations = array();

		foreach ($response as $channel) {
			
			$title = $channel->children[0]->children[0]->attr['title'];

			$array_chaines = array('TF1', 'France 2', 'France 3', 'Canal+', 'M6', 'D8', 'W9', 'TMC', 'NT1', 'D17');

			if(in_array(substr($title, 13), $array_chaines)) {

				$movie = $channel->children[1]->children[1]->children[2]->plaintext;

				$picture = '';

				if(isset($channel->children[1]->children[0]->children[1])) {
					$picture = $channel->children[1]->children[0]->children[1]->children[0]->attr['src'];
				}

				$stations[] = array(
					'title' => substr($title, 13),
					'movie' => $movie,
					'hour' => trim($channel->children[1]->children[1]->children[0]->plaintext),
					'picture' => $picture
				);
			}
		}

		return $stations;
	}
}
