<?php
class Beer implements JsonSerializable {
	public $beerId;
	public $beerName;

	public function __construct($newBeerId, $newBeerName) {
		$this->beerId = $newBeerId;
		$this->beerName = $newBeerName;
	}

	public function jsonSerialize() {
		return(get_object_vars($this));
	}
}

class JsonObjectStorage extends SplObjectStorage implements JsonSerializable {
	public function jsonSerialize() {
		$fields = [];

		foreach($this as $object) {
			$fields[] = $object;
			$object->info = $this[$object];
		}

		return($fields);
	}
}

$storage = new JsonObjectStorage();
$storage->attach(new Beer(1, "Tecate"), [1, 5]);
$storage->attach(new Beer(2, "La Cumbre BEER"), [2, 8]);
$storage->attach(new Beer(3, "Bud Light"), []); // not a beer - no tags :D

//foreach($storage as $foo) {
//	var_dump($foo);
//	var_dump($storage[$foo]);
//}

//$storage->rewind();
//for($i = 0; $i < count($storage); $i++) {
//	var_dump($storage->current());
//	var_dump($storage->getInfo());
//	$storage->next();
//}

header("Content-type: application/json");
echo json_encode($storage);