<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoload.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
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
	$reply->method = $method;

	// Sanitize inputs
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	// Make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}

	// Sanitize and trim the rest of the inputs
	$breweryDescription = filter_input(INPUT_GET, "breweryDescription", FILTER_SANITIZE_STRING);
	$breweryEstDate = filter_input(INPUT_GET, "breweryEstDate", FILTER_SANITIZE_STRING);
	$breweryHours = filter_input(INPUT_GET, "breweryHours", FILTER_SANITIZE_STRING);
	$breweryLocation = filter_input(INPUT_GET, "breweryLocation", FILTER_SANITIZE_STRING);
	$breweryName = filter_input(INPUT_GET, "breweryName", FILTER_SANITIZE_STRING);
	$breweryPhone = filter_input(INPUT_GET, "breweryPhone", FILTER_SANITIZE_STRING);
	$breweryUrl = filter_input(INPUT_GET, "breweryUrl", FILTER_SANITIZE_STRING);

	// Handle all restful calls
	if($method === "GET") {
		// Set XSRF cookie
//		setXsrfCookie("/");

		// Get the brewery based on the given
		if(empty($id) === false) {
			$brewery = BrewCrew\Brewery::getBreweryByBreweryId($pdo, $id);
			if($brewery !== null) {
				$reply->data = $brewery;
			}
		} else if(empty($breweryLocation) === false) {
			$reply->otherMessage = "inside get by location";
			$brewery = BrewCrew\Brewery::getBrewerybyBreweryLocation($pdo, $breweryLocation);
			if($brewery !== null) {
				$reply->data = $brewery;
			}
		} else if(empty($breweryName) === false) {
			$brewery = BrewCrew\Brewery::getBreweryByBreweryName($pdo, $breweryName);
			if($brewery !== null) {
				$reply->data = $brewery;
			}
		} else {
			$reply->otherMessage = "inside get all";
			$breweries = BrewCrew\Brewery::getAllBreweries($pdo);
			$reply->data = $breweries;
		}


		// PUT and POST
	}

	// Need to create permission for brewmasters to change what's on tap
//	if($_SESSION["user"]->getUserAccessLevel() === 1 && $_SESSION["user"]->getUserBreweryId() === $id) {

		if($method === "PUT" || $method === "POST") {

			// Set XSRF cookie
			//		verifyXsrf();
			$requestContent = file_get_contents("php://input");
			$requestObject = json_decode($requestContent);

			// Make sure all fields are present, in order, to prevent database issues
			if(empty($requestObject->breweryDescription) === true) {
				throw(new InvalidArgumentException ("breweryDescription cannot be empty", 405));
			}
			if(empty($requestObject->breweryHours) === true) {
				throw(new InvalidArgumentException ("breweryHours cannot be empty", 405));
			}
			if(empty($requestObject->breweryLocation) === true) {
				throw(new InvalidArgumentException ("breweryLocation cannot be empty", 405));
			}
			if(empty($requestObject->breweryName) === true) {
				throw(new InvalidArgumentException ("breweryName cannot be empty", 405));
			}
			if(empty($requestObject->breweryPhone) === true) {
				throw(new InvalidArgumentException ("breweryPhone cannot be empty", 405));
			}
			if(empty($requestObject->breweryUrl) === true) {
				throw(new InvalidArgumentException ("breweryUrl cannot be empty", 405));
			}

			// Perform the actual put or post
			if($method === "PUT") {

				// Retrieve the brewery to update
				$brewery = BrewCrew\Brewery::getBreweryByBreweryId($pdo, $id);
				if($brewery === null) {
					throw(new RuntimeException("Brewery does not exist", 404));
				}

				// Put the new brewery content into the brewery and update
				$brewery->setBreweryDescription($requestObject->breweryDescription);
				$brewery->setBreweryHours($requestObject->breweryHours);
				$brewery->setBreweryLocation($requestObject->breweryLocation);
				$brewery->setBreweryName($requestObject->breweryName);
				$brewery->setBreweryPhone($requestObject->breweryPhone);
				$brewery->setBreweryUrl($requestObject->breweryUrl);
				$brewery->update($pdo);
				$reply->message = "Brewery updated";

			} else if($method === "POST") {

				//  Make sure breweryEstDate is available
				if(empty($requestObject->breweryEstDate) === true) {
					throw(new InvalidArgumentException ("breweryEstDate cannot be empty", 405));
				}

				// Create new brewery and insert into the database
				$brewery = new BrewCrew\Brewery(null, $requestObject->breweryDescription, $requestObject->breweryEstDate, $requestObject->breweryHours, $requestObject->breweryLocation, $requestObject->breweryName, $requestObject->breweryPhone, $requestObject->breweryUrl);
				$brewery->insert($pdo);

				// Update reply
				$reply->message = "Brewery created";
			}
		} else if($method === "DELETE") {
//				verifyXsrf();

			// Retrieve the brewery to be deleted
			$brewery = BrewCrew\Brewery::getBreweryByBreweryId($pdo, $id);
//			var_dump($brewery);
			if($brewery === null) {
				throw(new RuntimeException("Brewery does not exist", 404));
			}

			// Delete Brewery
			$brewery->delete($pdo);
//			$deletedObject = new stdClass();

			// Update reply
			$reply->message = "Brewery deleted";
		}
//	}
	else {
		throw (new InvalidArgumentException("Invalid HTTP method request"));
	}


	// Update reply with exception information
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
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