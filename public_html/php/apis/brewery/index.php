<?php

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\BrewCrew;


/**
 * API for the Brewery class
 *
 * @author Kate McGaughey <therealmcgaughey@gmail.com>
 **/

// Verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

// Prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	// Grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/brewcrew.ini");

	// Determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	// Sanitize input
	$breweryId = filter_input(INPUT_GET, "breweryId", FILTER_VALIDATE_INT);

	// Make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($breweryId) === true || $breweryId < 0)) {
		throw(new InvalidArgumentException("Brewery id cannot be empty or negative", 405));
	}
	// Handle GET request - if breweryId is present, that brewery is returned, otherwise all breweries are returned
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		// Get a specific brewery or all breweries and update reply
		if(empty($breweryId) === false) {
			$brewery = Edu\Cnm\BrewCrew\Brewery::getBreweryByBreweryId($pdo, $breweryId);
			if($brewery !== null) {
				$reply->data = $brewery;
			}
		}  else {
			$breweries = Edu\Cnm\BrewCrew\Brewery::getAllBreweries($pdo);
			if($breweries !== null) {
				$reply->data = $breweries;
			}
		}
	} else if($method === "PUT" || $method === "POST") {

		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		// Make sure brewery content is available
		if(empty($requestObject->breweryContent) === true) {
			throw(new \InvalidArgumentException ("No content for Brewery.", 405));
		}


		// Perform the actual put or post
		if($method === "PUT") {

			// Retrieve the brewery to update
			$brewery = Edu\Cnm\BrewCrew\Brewery::getBreweryByBreweryId($pdo, $breweryId);
			if($brewery === null) {
				throw(new RuntimeException("Brewery does not exist", 404));
			}

			// Put the new brewery content into the brewery and update
			$brewery->setBreweryContent($requestObject->breweryContent);
			$brewery->update($pdo);

			// Update reply
			$reply->message = "Brewery updated OK";

		} else if($method === "POST") {

			//  Make sure breweryId is available
			if(empty($requestObject->breweryId) === true) {
				throw(new \InvalidArgumentException ("No Brewery ID.", 405));
			}

			// Create new brewery and insert into the database
			$brewery = new Edu\Cnm\BrewCrew\Brewery(null, $requestObject->breweryId, $requestObject->breweryContent, null);
			$brewery->insert($pdo);

			// Update reply
			$reply->message = "Brewery created OK";
		}

	} else if($method === "DELETE") {
		verifyXsrf();

		// Retrieve the Brewery to be deleted
		$brewery = Edu\Cnm\BrewCrew\Brewery::getBreweryByBreweryId($pdo, $breweryId);
		if($brewery === null) {
			throw(new RuntimeException("Brewery does not exist", 404));
		}

		// Delete Brewery
		$brewery->delete($pdo);

		// Update reply
		$reply->message = "Brewery deleted OK";
	} else {
		throw (new InvalidArgumentException("Invalid HTTP method request"));
	}

	// Update reply with exception information
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
	$reply->trace = $exception->getTraceAsString();
} catch(TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}

header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}

// Encode and return reply to front end caller
echo json_encode($reply);