<?php

class MiaTraduction extends Mia {

	protected $trads = array(
		'fr' => array(
			'happy' => "Contente",
			'angry' => "Enervée",
			'sleepy' => "Fatiguée"
		)
	);

	public function trad($entry, $lang) {

		if(isset($this->trads[$lang][strtolower($entry)])) {
			return $this->trads[$lang][strtolower($entry)];
		}

		return $entry;
	}
}
