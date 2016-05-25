<?php

class MiaKnowledge extends Mia {

	public function getFirstLaw() {
		return $this->echoGoogle("Première loi : Un robot ne peut pas faire de mal à un être humain.");
	}

	public function getSecondLaw() {
		return $this->echoGoogle("Seconde loi : Un robot doit obéir à tout ordre qui lui est donné par un humain.");
	}

	public function getThirdLaw() {
		return $this->echoGoogle("Troisième loi : Un robot à le droit de se défendre, tant que cela n'entre pas en collision avec la première ou la seconde loi.");
	}

	public function getThreeLaws() {
		return $this->echoGoogle("Première loi : Un robot ne peut pas faire de mal à un être humain. Seconde loi : Un robot doit obéir à tout ordre qui lui est donné par un humain. Troisième loi : Un robot à le droit de se défendre, tant que cela n'entre pas en collision avec la première ou la seconde loi.");
	}

	public function RikuFavoriteManga() {
		return $this->echoGoogle("Le manga favori de Kevin est Gintama.");
	}

	public function HikenFavoriteManga() {
		return $this->echoGoogle("Le manga favori de Médrick est Jojo's bizarre adventure.");
	}

	public function counselMeAManga() {
		$answers = array(
			0 => "Cela fait longtemps que vous n'avez pas lu Kenshin.",
			1 => "Vous souhaitiez lire Red Storm"
		);

		return $this->echoGoogle($this->randomAnswer($answers));
	}

	public function whatDoIDo() {

		$answers = array(
			0 => "Cela fait longtemps que vous n'avez pas lu Kenshin.",
			1 => "Plusieurs Rocky sont toujours en attente de visionnage",
			2 => "La deuxième trilogie des Star Wars attend d'être vue."
		);

		return $this->echoGoogle($this->randomAnswer($answers));
	}

	public function itAngersMe() {

		$answers = array(
			0 => "Que se passe t-il ?"
		);

		return $this->echoGoogle($this->randomAnswer($answers));
	}

	public function getNews() {

		require("C:/wamp/www/mia/vendor/autoload.php");

		$api_key = "ce03ea48-a68c-4452-846c-d7c6490cc3b1";
		$query = "";
		$ts = "1456583252629";

		$language = " language:(french)";
		$country = " thread.country:FR";
		$site = " site:france24.com";

		// var_dump(urldecode("%3A"));
		// die;

		$q = urlencode($query).urlencode($language).urlencode($country).urlencode($site);

		// &q=language%3A(french)%20thread.country%3AFR%20site%3Afrance24.com%20(site_type%3Anews%20OR%20site_type%3Ablogs)&ts=1456586320763

		Unirest\Request::verifyPeer(false);
		$response = Unirest\Request::get("https://webhose.io/search?token=".$api_key."&format=json&q=".$q."%20(site_type%3Anews%20OR%20site_type%3Ablogs)&ts=".$ts,
	        array(
	        	"Accept" => "text/plain"
	        )
	    );

	    $i = 0;
	    $titles = array();

	    // var_dump($response);
	    // die;

	    foreach ($response->body->posts as $post) {

	    	if($i < 7) {
	    		if(!in_array($post->thread->title, $titles)) {
	    			array_push($titles, $post->thread->title);
	    			$i++;
	    		}

	    	} else {
	    		break;
	    	}	    	
	    }

	    // var_dump($titles);
	    // die;

	    return $this->echoGoogle($this->randomAnswer($titles));
	}
}
