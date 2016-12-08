<?php

class MiaTraduction extends Mia {

	protected $trads = array(
		'happy' => "Contente",
		'angry' => "Enervée",
		'sleepy' => "Fatiguée"
	);

	public function trad($entry) {

		if(isset($this->trads[strtolower($entry)])) {
			return $this->trads[strtolower($entry)];
		}

		return $entry;
	}
}
