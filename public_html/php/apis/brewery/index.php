<?php
require_once dirname(dirname(__DIR__)) . "/classes/autoloader.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
require_once dirname(dirname(__DIR__)) . "/lib/sendEmail.php";

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
// This $reply is an empty bucket we store the results of our calls in


try {
	// Grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/brewcrew.ini");

	// Determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];
	$reply->method=$method;

	// Sanitize inputs
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	// Make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}
	
	// Sanitize and trim the rest of the inputs
	$breweryId = filter_input(INPUT_GET, "breweryId", FILTER_VALIDATE_INT);
	$breweryDescription = filter_input(INPUT_GET, "breweryDescription", FILTER_VALIDATE_INT);
	$breweryEstDate = filter_input(INPUT_GET, "breweryEstDate", FILTER_VALIDATE_INT);
	$breweryHours = filter_input(INPUT_GET, "breweryHours", FILTER_VALIDATE_INT);
	$breweryLocation = filter_input(INPUT_GET, "breweryLocation", FILTER_VALIDATE_INT);
	$breweryName = filter_input(INPUT_GET, "breweryName", FILTER_VALIDATE_INT);
	$breweryPhone = filter_input(INPUT_GET, "breweryPhone", FILTER_VALIDATE_INT);
	$breweryUrl = filter_input(INPUT_GET, "breweryUrl", FILTER_VALIDATE_INT);

	// Handle all restful calls
	if($method === "GET") {
		// Set XSRF cookie
		setXsrfCookie("/");

		// Get the brewery based on the given
		if(empty($id) === false) {
			$brewery = Brewery::getBreweryByBreweryId($pdo, $id);
			if($brewery !== null) {
				$reply->data = $brewery;
			}
			else if(empty($breweryLocation) === false) {
				$brewery = Brewery::getBreweryByBreweryLocation($pdo, $breweryLocation);
				if($brewery !== null) {
					$reply->data = $brewery;
				}
			} else if(empty($breweryName) === false) {
				$brewery = Brewery::getBreweryByBreweryName($pdo, $breweryName);
				if($brewery !== null) {
					$reply->data = $brewery;
				}
			} else {
				$brewery = Brewery::getAllBreweries($pdo);
				$reply->data = $breweries;
			}
		}
		// PUT and POST
	} else if($method === "PUT" || $method === "POST") {
		verifyXsrf();
		$requestObject = file_get_contents("php://input"); 
		$requestObject = json_decode($requestContent);

		// Make sure all fields are present in order to prevent database issues
		if(empty($requestObject->breweryId) === true) {
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