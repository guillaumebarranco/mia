<?php

require_once __DIR__.'/../libs/simple_html_dom.php';
require_once __DIR__.'/../libs/TwitterAPIExchange.php';
use Twitter\twitter\TwitterAPIExchange;

class MiaPage extends Mia {

	function getTodayDate() {
		global $miaFunctions;

		$date = explode('-', date('Y-m-d')); ;

		$year = $date[0];
		$month = $miaFunctions->transformMonthToString($date[1]);
		$day = $date[2];

		return 'Nous sommes le '.$day.' '.$month.' '.$year.$miaFunctions->getFete();
	}

	public function getMeteo() {

		$apikey = "aa870edae9ce0abe6b9751aa67743a71";

		// 6455259 is Paris
		$cl = curl_init("http://api.openweathermap.org/data/2.5/weather?id=6455259&units=metric&appid=".$apikey);
		curl_setopt($cl,CURLOPT_RETURNTRANSFER,true);
		$today = json_decode(curl_exec($cl));

		$cl = curl_init("http://api.openweathermap.org/data/2.5/forecast?id=6455259&units=metric&appid=".$apikey);
		curl_setopt($cl,CURLOPT_RETURNTRANSFER,true);
		$forecast = json_decode(curl_exec($cl));

		$datas = array(
			"today" => $today,
			"forecast" => $forecast,
			"day" => $this->getTodayDate(),
			"hour" => time()
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

	public function getTwitterFeed($type = 'username', $search = 'Webarranco', $link_saved = array()) {
		// APPEL A L'API

		$settings = array(
		    'oauth_access_token' => "2538080443-GozX3u7rLh5EO8cfbBuLFNxI9jTwqZIx2GgY6yP",
		    'oauth_access_token_secret' => "gfvwyItUpcnXVQhxgHxvINsCNOlmgw2vxPc81yeOhsdnF",
		    'consumer_key' => "p0gzW0PRw9XlJnZrFCEncNx0P",
		    'consumer_secret' => "x1pFnIFYal9qvscgAs1THe7tzXGs1p5I7BMjl8bSwXNFtWOux5"
		);

		$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

		$getfield = '?screen_name='.$search;
		$requestMethod = 'GET';
		$twitter = new TwitterAPIExchange($settings);

		$json_twitter = $twitter->setGetfield($getfield)
			->buildOauth($url, $requestMethod)
			->performRequest();

		$twitter_datas = json_decode($json_twitter, true);
		// GESTION DES DONNEES RETOURNEES
		$datas = array();

		if (isset($twitter_datas[0]['user']['screen_name'])) {
			$datas['twitter'][0] = $twitter_datas[0]['user']['screen_name'];
	    	$t = 1;

			foreach ($twitter_datas as $key => $status) {

				if(empty($status['retweeted_status']) && $status['in_reply_to_status_id'] === null) {

					if(!in_array('https://twitter.com/'.$search.'/status/'.$status['id_str'], $link_saved)) { 
						// Filter by posts saved

						$datas['twitter'][$t] = array();
						$datas['twitter'][$t]['text'] = $status['text'];
						$datas['twitter'][$t]['link'] = 'https://twitter.com/'.$search.'/status/'.$status['id_str'];
						// Pour être sur, une fois le lien sauvegardé pour un tweet, on le met dans le tableau pour qu'il ne puisse pas réapparaitre
						$link_saved[] = $datas['twitter'][$t]['link'];
						$t++;
					}
				}
			}
		}
		return $datas;
	}

	public function getATPClassement() {

		$classement = array();

		$html = file_get_html('http://www.lequipe.fr/Tennis/atp-classement.html');

		$response = $html->find('.classement');

		$number = isset($_GET['number']) ? $_GET['number'] : 5;

		for ($i=0; $i < $number; $i++) {

			$ranking = $response[0]->children[1]->children[$i]->children[0]->plaintext;
			$country = $response[0]->children[1]->children[$i]->children[2]->plaintext;
			$points = $response[0]->children[1]->children[$i]->children[3]->plaintext;

			$player = $response[0]->children[1]->children[$i]->children[1];

			$link = $name = $player->children[1]->attr['href'];

			$name = $player->children[1]->children[0]->plaintext;

			// Second request
			$html2 = file_get_html("http://www.lequipe.fr".$link);

			$infos_image = $html2->find('.sportif-image');
			$picture = $infos_image[0]->children[0]->attr['src'];

			// current saison

			$currentSaison = $html2->find('#sportif-saison')[0]->children[0];


			$victories = $currentSaison->children[0];
			$number_titles = $victories->children[0]->plaintext;

			$all_victories = array();

			for ($j=0; $j < intval($number_titles); $j++) { 
				$all_victories[] = utf8_encode($victories->children[1]->children[0]->children[$j]->plaintext);
			}

			$ratio = "Inconnu";

			if(count($currentSaison->children) === 3) {
				$ratio = $currentSaison->children[1]->children[1]->plaintext;
			} else if(count($currentSaison->children) === 4) {
				$ratio = $currentSaison->children[2]->children[1]->plaintext;
			} else if(count($currentSaison->children) === 2) {
				$ratio = $currentSaison->children[0]->children[1]->plaintext;
			}

			// last saison

			$last_currentSaison = $html2->find('#sportif-saison')[1]->children[0];

			$last_victories = $last_currentSaison->children[0];
			$last_number_titles = $last_victories->children[0]->plaintext;

			$last_all_victories = array();

			for ($last_i=0; $last_i < intval($last_number_titles); $last_i++) { 
				$last_all_victories[] = $last_victories->children[1]->children[0]->children[$last_i]->plaintext;
			}

			$last_ratio = "Inconnu";

			if(count($last_currentSaison->children) === 3) {
				$last_ratio = $last_currentSaison->children[1]->children[1]->plaintext;
			} else if(count($last_currentSaison->children) === 4) {
				$last_ratio = $last_currentSaison->children[2]->children[1]->plaintext;
			} else if(count($last_currentSaison->children) === 2) {
				$last_ratio = $last_currentSaison->children[0]->children[1]->plaintext;
			}

			$classement[] = array(
				'ranking' => trim($ranking),
				'country' => trim($country),
				'points' => trim($points),
				'name' => trim($name),
				'picture' => trim($picture),

				'popup' => array(
					'currentSaison' => array(
						'nbVictories' => $number_titles,
						'victories' => $all_victories,
						'ratio' => $ratio
					),
					'lastSaison' => array(
						'nbVictories' => $last_number_titles,
						'victories' => $last_all_victories,
						'ratio' => $last_ratio
					)
				)
			);
		}

		return $classement;
	}
}
