<?php

require_once dirname(__DIR__) . "/classes/autoload.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
$config = readConfig("/etc/apache2/capstone-mysql/brewcrew.ini");
$breweryDbApiKey = $config["breweryDbKey"];

// Grab the mySQL connection
$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/brewcrew.ini");

$breweryIds = [];
$regions = ["NM", "New+Mexico"];
foreach($regions as $region) {
	$i = 1;
	$locationsUrl = "http://api.brewerydb.com/v2/locations/?key=$breweryDbApiKey&isClosed=N&region=$region&p=$i";
	$locations = json_decode(file_get_contents($locationsUrl));
	//
	echo $i . "<br>";

	if($locations->numberOfPages >= 1) {
		echo "number of page = " . $locations->numberOfPages . "<br>";
		for($i = 2; $i <= $locations->numberOfPages; $i++) {
			echo $i . "<br>";
			foreach($locations->data as $location) {
			
				if(empty($location->brewery->description) === false) {
					$description = $location->brewery->description;
				} else {
					$description = "N/A";
				}
				if(empty($location->brewery->established) === false) {
					$established = $location->brewery->established;
				} else {
					$established = "2016";
				}
				if(empty($location->hoursOfOperation) === false) {
					$hoursOfOperation = $location->hoursOfOperation;
				} else {
					$hoursOfOperation = "N/A";
				}
				if(empty($location->streetAddress) === false) {
					$streetAddress = $location->streetAddress;
				} else {
					$streetAddress = "N/A";
				}
				if(empty($location->phone) === false) {
					$phone = $location->phone;
				} else {
					$phone = "N/A";
				}
				if(empty($location->website) === false) {
					$website = $location->website;
				} else {
					$website = "N/A";
				}

				$brewery = new \Edu\Cnm\BrewCrew\Brewery (null,
					$location->brewery->id,
					$description,
					$established,
					$hoursOfOperation,
					$streetAddress,
					$location->brewery->name,
					$phone,
					$website);

				// Check for duplicates
				$existingBreweries = \Edu\Cnm\BrewCrew\Brewery::getAllBreweries($pdo);
				$canInsert = true;
				foreach($existingBreweries as $existingBrewery) {
					if($brewery->getBreweryDbKey() === $existingBrewery->getBreweryDbKey()) {
						$canInsert = false;
						echo "duplicate found" . "<br>";
					}
				}

				if($canInsert === true) {
					$brewery->insert($pdo);
				}
			}

			$locationsUrl = "http://api.brewerydb.com/v2/locations/?key=$breweryDbApiKey&isClosed=N&region=$region&p=$i";
		}
	}
}
