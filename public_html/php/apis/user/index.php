<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoload.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\BrewCrew;

/**
 * API for user class
 *
 * @author Kate McGaughey therealmcgaughey@gmail.com
 *
 * @see https://github.com/CreativeCorrie/time-crunchers/blob/master/public_html/php/api/user/index.php for api I copied
 */

// Verify xsrf challenge
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
// Prepare a empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	// Grab the MySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/brewcrew.ini");

	// Determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	// Sanitize inputs
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	// Make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be negative or empty", 405));
	}

	// Sanitize and trim other fields
	$userId = filter_input(INPUT_GET, "userId", FILTER_VALIDATE_INT);
	$userBreweryId = filter_input(INPUT_GET, "userBreweryId", FILTER_VALIDATE_INT);
	$userAccessLevel = filter_input(INPUT_GET, "userAccessLevel", FILTER_VALIDATE_INT);
	$userActivationToken = filter_input(INPUT_GET, "userActivationToken", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$userEmail = filter_input(INPUT_GET, "userEmail", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$userUsername = filter_input(INPUT_GET, "userUsername", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	// Handle rest calls, while only allowing admins to access database-modifying methods
	if($method === "GET") {
		// Set XSRF cookie
		setXsrfCookie("/");

		// Get the user based on the given
		 if(empty($userUsername) === false) {
			$user = BrewCrew\User::getUserByUserUsername($pdo, $userUsername);
			if($user !== null) {
				$reply->data = $user;
			}
		} else {
			if(empty($_SESSION["user"]) === false) {
				$reply->data = $_SESSION["user"];
			} else {
				$reply->data = new stdClass();
			}
		}

	} else if($method === "PUT") {
		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		// Make sure all fields are present in order to prevent database issues
		$requestObject->userEmail = (filter_var($requestObject->userEmail, FILTER_SANITIZE_EMAIL));
		$requestObject->userFirstName = (filter_var($requestObject->userFirstName, FILTER_SANITIZE_STRING));
		$requestObject->userLastName = (filter_var($requestObject->userLastName, FILTER_SANITIZE_STRING));
		$requestObject->userUsername = (filter_var($requestObject->userUsername, FILTER_SANITIZE_STRING));
		if(empty($requestObject->userEmail) === true) {
			throw(new InvalidArgumentException ("Email cannot be empty", 405));
		}
		if(empty($requestObject->userFirstName) === true) {
			throw(new InvalidArgumentException ("First ame cannot be empty", 405));
		}
		if(empty($requestObject->userLastName) === true) {
			throw(new InvalidArgumentException ("Last name cannot be empty", 405));
		}
		if(empty($requestObject->userUsername) === true) {
			throw(new InvalidArgumentException ("Username cannot be empty", 405));
		}

		// Perform the actual put
		$user = BrewCrew\User::getUserByUserId($pdo, $id);
		if($user === null) {
			throw(new RuntimeException("User does not exist.", 404));
		}

		// If there's a password, hash it and set it
		if(isset($requestObject->userPassword) === true && isset($requestObject->confirmPassword) === true) {
			if($requestObject->userPassword !== $requestObject->confirmPassword) {
				throw (new \RangeException("Passwords do not match."));
			} else {
				$hash = hash_pbkdf2("sha512", $requestObject->userPassword, $user->getUserSalt(), 262144);
				$user->setUserHash($hash);
			}
		}
		// Put the new user content into the user and update
		$user->setUserEmail($requestObject->userEmail);
		$user->setUserFirstName($requestObject->userFirstName);
		$user->setUserLastName($requestObject->userLastName);
		$user->setUserUsername($requestObject->userUsername);
		$user->update($pdo);
		$reply->message="User updated successfully.";

	} else if ($method === "DELETE") {
		//$reply->debug="Delete started.";
		$user = BrewCrew\User::getUserByUserId($pdo, $id);
		if($user === null) {
			throw(new RuntimeException("User does not exist.", 404));
		}
		$user->delete($pdo);
		$deletedObject = new stdClass();
	}

	header("Content-type: application/json");
	$reply = json_encode($reply);
	unset($reply->salt);
	unset($reply->hash);
	echo $reply;

} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
	header("Content-type: application/json");
	echo (json_encode($reply));

} catch(\TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
	header("Content-type: application/json");
	echo (json_encode($reply));
}
