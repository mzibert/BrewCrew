<?php

require_once "../public_html/php/classes/autoload.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
$config = readConfig("/etc/apache2/capstone-mysql/brewcrew.ini");
$breweryDbApiKey = $config["breweryDbKey"];

// Grab the mySQL connection
$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/brewcrew.ini");

try {
	$breweries = \Edu\Cnm\BrewCrew\Brewery::getAllBreweries($pdo);
	foreach($breweries as $brewery) {
		$breweryDbKey = $brewery->getBreweryDbKey();
		$i = 1;
		$beerUrl = "http://api.brewerydb.com/v2/brewery/$breweryDbKey/beers/?key=$breweryDbApiKey&p=$i";
		$beers = json_decode(file_get_contents($beerUrl));
		if($beers->status !== "success") {
			throw(new InvalidArgumentException("brewery DB made a boo boo"));
		}
		if(isset($beers->numberOfPages) === false) {
			$beers->numberOfPages = 1;
		}
		if($beers->numberOfPages >= 1) {
			//increment number of pages
//			for($i = 2; $i <= $beers->numberOfPages; $i++);

			foreach($beers->data as $beer) {

				//look for the data, if not there set the default value
				if(empty($beer->abv) === false) {
					$abv = $beer->abv;
				} else {
					$abv = 100;
				}
				if(empty($beer->available->description) === false) {
					$availability = $beer->available->description;
				} else {
					$availability = "N/A";
				}
				//get color value from srm values
				if(empty($beer->srm->name) === false) {
					$srm = filter_var($beer->srm->name, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
					$srm =  $srm / 40;
				} elseif(empty($beer->style->srmMin && $beer->style->srmMax ) === false || empty($srm) === true) {
					$srmMin = filter_var($beer->style->srmMin, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
					$srmMax = filter_var($beer->style->srmMax, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
					$srm = (($srmMax + $srmMin) / 2.0) / 40;
				} else {
					$srm = false;
				}
				
				// just when @deepdivedylan thought he loved honey ales...
				//setting color for unspecific colors
				if($srm > 1.0) {
					$srm = 0.6;
				}
				
				if(empty($beer->description) === false) {
					$description = $beer->description;
				} else {
					$description = "N/A";
				}
				if(empty($beer->ibu) === false) {
					$ibu = $beer->ibu;
				} else {
					$ibu = "N/A";
				}
				if(empty($beer->name) === false) {
					$name = $beer->name;
				} else {
					$name = "N/A";
				}
				if(empty($beer->style->shortName) === false) {
					$style = $beer->style->shortName;
				} else {
					$style = "N/A";
				}
				$awards = "N/A";

				//Prepare to insert beer
				$beer = new Edu\Cnm\BrewCrew\Beer(null, $brewery->getBreweryId(), $abv, $availability, $awards, $srm, $beer->id, $description, $ibu, $name, $style);

				//Check for duplicates
				//Allow new beers to be added
				$existingBeer = \Edu\Cnm\BrewCrew\Beer::getBeerByBeerDbKey($pdo, $beer->getBeerDbKey());
				$canInsert = true;
				if($existingBeer !== null && $beer->getBeerDbKey() === $existingBeer->getBeerDbKey()) {
					$canInsert = false;
				}

				//insert or update beer
				if($canInsert === true) {
					$beer->insert($pdo);
				} else {
					$existingBeer->update($pdo);
				}

			}
		}
	}
} catch(Exception $exception) {
	echo "Exception: " . $exception->getMessage() . PHP_EOL;
}