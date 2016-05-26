<?php

require_once "autoload.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/mlbscout-mysql/encrypted-config.php");

use Edu\Cnm\BrewCrew;


/**
 * api for the User class
 *
 * @author Arlene Carol Graham <agraham14@cnm.edu>
 **/

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
	$pdo = connectToEncryptedMySQL("/etc/apache2/brewcrew-mysql/user.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}

	// handle GET request - if id is present, that user is returned, otherwise all users are returned
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get a specific user or all users and update reply
		if(empty($id) === false) {
			$user = BrewCrew\User::getUserByUserId($pdo, $id);
			if($user !== null) {
				$reply->data = $user;
			}
		}  else {
			$users = BrewCrew\User::getAllUsers($pdo);
			if($users !== null) {
				$reply->data = $users;
			}
		}
	} else if($method === "PUT" || $method === "POST") {

		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//make sure user content is available
		if(empty($requestObject->userContent) === true) {
			throw(new \InvalidArgumentException ("No content for User.", 405));
		}


		//perform the actual put or post
		if($method === "PUT") {

			// retrieve the user to update
			$user = BrewCrew\User::getUserByUserId($pdo, $id);
			if($user === null) {
				throw(new RuntimeException("User does not exist", 404));
			}

			// put the new user content into the user and update
			$user->setUserContent($requestObject->userContent);
			$user->update($pdo);

			// update reply
			$reply->message = "User updated OK";

		} else if($method === "POST") {

			//  make sure profileId is available
			if(empty($requestObject->profileId) === true) {
				throw(new \InvalidArgumentException ("No Pofile ID.", 405));
			}

			// create new user and insert into the database
			$user = new BrewCrew\User(null, $requestObject->profileId, $requestObject->userContent, null);
			$user->insert($pdo);

			// update reply
			$reply->message = "User created OK";
		}

	} else if($method === "DELETE") {
		verifyXsrf();

		// retrieve the User to be deleted
		$user = BrewCrew\User::getUserByUserId($pdo, $id);
		if($user === null) {
			throw(new RuntimeException("User does not exist", 404));
		}

		// delete user
		$user->delete($pdo);

		// update reply
		$reply->message = "User deleted OK";
	} else {
		throw (new InvalidArgumentException("Invalid HTTP method request"));
	}

	// update reply with exception information
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

// encode and return reply to front end caller
echo json_encode($reply);