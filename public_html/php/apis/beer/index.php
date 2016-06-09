<?php

/**
 * GET all beers
 * GET a specific beer by primary key
 * GET beers by brewery Id
 * GET beer by IBU
 * GET beer by beer color
 * GET beer by beer name
 * GET beer by style
 * POST create a brand new beer
 * PUT update beer
 * DELETE a beer
 **/
require_once dirname(dirname(__DIR__)) . "/classes/autoload.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\BrewCrew;


/**
 * api for the beer class
 *
 * @author Arlene Carol Graham <agraham14@cnm.edu>
 */

//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/brewcrew.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] :$_SERVER["REQUEST_METHOD"];
	$reply->method = $method;

	//Sanitize input
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}

	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		$beerBreweryId = filter_input(INPUT_GET, "beerBreweryId", FILTER_VALIDATE_INT);
		$beerColor = filter_input(INPUT_GET, "beerColor", FILTER_SANITIZE_NUMBER_FLOAT);
		$beerIbu = filter_input(INPUT_GET, "beerIbu", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		$beerName = filter_input(INPUT_GET, "beerName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		$beerStyle = filter_input(INPUT_GET, "beerStyle", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);


		//get a specific beer or all beers and update reply
		if(empty($id) === false) {
			$beer = BrewCrew\Beer::getBeerByBeerId($pdo, $id);
			if($beer !== null) {
				$beerTags = BrewCrew\BeerTag::getBeerTagByBeerId($pdo, $beer->getBeerId());
				$storage = new BrewCrew\JsonObjectStorage();
				$storage->attach($beer, $beerTags->toArray());
				$reply->data = $storage;
			}

		} else if(empty($beerBreweryId) === false) {
			$beers = BrewCrew\Beer::getBeerByBeerBreweryId($pdo, $beerBreweryId)->toArray();
			if($beers !== null) {
				$storage = new BrewCrew\JsonObjectStorage();
				foreach($beers as $beer) {
					$beerTags = BrewCrew\BeerTag::getBeerTagByBeerId($pdo, $beer->getBeerId());
					$storage->attach($beer, $beerTags->toArray());
					$reply->data = $storage;
				}
			}

		} else if(empty($beerColor) === false) {
			$beers = BrewCrew\Beer::getBeerByBeerColor($pdo, $beerColor)->toArray();
			if($beers !== null) {
				$storage = new BrewCrew\JsonObjectStorage();
				foreach($beers as $beer) {
					$beerTags = BrewCrew\BeerTag::getBeerTagByBeerId($pdo, $beer->getBeerId());
					$storage->attach($beer, $beerTags->toArray());
					$reply->data = $storage;
				}
			}

		} else if(empty($beerIbu) === false) {
			$beers = BrewCrew\Beer::getBeerByBeerIbu($pdo, $beerIbu)->toArray();
			if($beers !== null) {
				$storage = new BrewCrew\JsonObjectStorage();
				foreach($beers as $beer) {
					$beerTags = BrewCrew\BeerTag::getBeerTagByBeerId($pdo, $beer->getBeerId());
					$storage->attach($beer, $beerTags->toArray());
					$reply->data = $storage;
				}
			}

		} else if(empty($beerName) === false) {
			$beers = BrewCrew\Beer::getBeerByBeerName($pdo, $beerName)->toArray();
			if($beers !== null) {
				$storage = new BrewCrew\JsonObjectStorage();
				foreach($beers as $beer) {
					$beerTags = BrewCrew\BeerTag::getBeerTagByBeerId($pdo, $beer->getBeerId());
					$storage->attach($beer, $beerTags->toArray());
					$reply->data = $storage;
				}
			}

		} else if(empty($beerStyle) === false) {
			$beers = BrewCrew\Beer::getBeerByBeerStyle($pdo, $beerStyle)->toArray();
			if($beers !== null) {
				$storage = new BrewCrew\JsonObjectStorage();
				foreach($beers as $beer) {
					$beerTags = BrewCrew\BeerTag::getBeerTagByBeerId($pdo, $beer->getBeerId());
					$storage->attach($beer, $beerTags->toArray());
					$reply->data = $storage;
				}
			}
		}

	} else if($method === "PUT" || $method === "POST") {
		verifyXsrf();
		$requestBeerContent = file_get_contents("php://input");
		$requestBeerObject = json_decode($requestBeerContent);

		$beerAvailability = filter_var($requestBeerObject->beerAvailability, FILTER_SANITIZE_STRING);
		$beerAwards = filter_var($requestBeerObject->beerAwards, FILTER_SANITIZE_STRING);
		$beerDescription = filter_var($requestBeerObject->beerDescription, FILTER_SANITIZE_STRING);
		$beerBreweryId = filter_var($requestBeerObject->beerBreweryId, FILTER_VALIDATE_INT);
		$beerAbv = filter_var($requestBeerObject->beerAbv, FILTER_SANITIZE_NUMBER_FLOAT);
		$beerColor = filter_var($requestBeerObject->beerColor, FILTER_SANITIZE_NUMBER_FLOAT);
		$beerIbu = filter_var($requestBeerObject->beerIbu, FILTER_SANITIZE_STRING);
		$beerName = filter_var($requestBeerObject->beerName, FILTER_SANITIZE_STRING);
		$beerStyle = filter_var($requestBeerObject->beerStyle, FILTER_SANITIZE_STRING);


			//perform the actual put or post

			if($method === "PUT") {

				$beer = BrewCrew\Beer::getBeerByBeerId($pdo, $id);

				if($beer === null) {
					throw(new RuntimeException("Beer is not available", 404));
				}


// retrieve the beer by availability

// update beer by availability
				$beer->setBeerAbv($beerAbv);
				$beer->setBeerAvailability($beerAvailability);
				$beer->setBeerAwards($beerAwards);
				$beer->setBeerColor($beerColor);
				$beer->setBeerDescription($beerDescription);
				$beer->setBeerIbu($beerIbu);
				$beer->setBeerName($beerName);
				$beer->setBeerStyle($beerStyle);
				$beer->update($pdo);
// update reply
				$reply->message = "Beer updated successfully";

				//perform the actual put or post
			} else if($method === "POST") {


				$beer = new BrewCrew\Beer(null, $beerBreweryId, $beerAbv, $beerAvailability, $beerAwards, $beerColor, $beerDescription, $beerIbu, $beerName, $beerStyle);

				$beer->insert($pdo);
				// update reply
				$reply->message = "Beer inserted successfully";
				$reply->data = $beer;

			} else {
				//if not an admin, and attempting a method other than get, throw an exception
				if((empty($method) === false) && ($method !== "GET")) {
					throw(new RuntimeException("Only administrators are allowed to modify entries", 401));
				}
			}
		} else if($method === "DELETE") {
			verifyXsrf();

			$beer = BrewCrew\Beer::getBeerByBeerId($pdo, $id);

			if(empty($beer) === true) {
				throw(new RuntimeException("Beer does not exist", 404));
			}

			$beer->delete($pdo);
			$deletedBeerObject = new stdClass();
			$deletedBeerObject->beerId = $id;
			$reply->message = "Beer deleted OK";
		}


	}
catch
	(Exception $exception) {

		$reply->status = $exception->getCode();
		$reply->message = $exception->getMessage();
		$reply->trace = $exception->getTraceAsString();

	} catch(\TypeError $typeError) {

		$reply->status = $typeError->getCode();
		$reply->message = $typeError->getMessage();
		$reply->trace = $typeError->getTraceAsString();

	}

header("Content-type: application/json");
echo json_encode($reply);

