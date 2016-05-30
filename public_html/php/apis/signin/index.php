<?php

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once "/etc/apache2/capstone-mysql/encrypted-config.php";

use Edu\Cnm\BrewCrew;

/**
 * api for signing in
 *
 * allows for interacting with the backend
 * @author Alicia Broadhurst <abroadhurst@cnm.edu>
 **/

//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare default error message
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/signin.api");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	verifyXsrf();

	//perform the actual POST
	if($method === "POST") {


		// convert JSON to an object
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//check that username and password fields have been filled, and sanitize
		if(empty($requestObject->userName) === true) {
			throw(new \InvalidArgumentException("Must enter a username", 405));
		} else {
			$userName = filter_var($requestObject->userName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		}

		if (empty($requestObject->userPassword) === true) {
			throw(new \InvalidArgumentException ("Must enter a password", 405));
		} else {
			$password = filter_var($requestObject->userPassword, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		}

		//create the user
		$user = User::getUserbyUserName($pdo, $userName);

		//if the user doesn't exist, throw an exception
		if(empty($user)) {
			throw (new \InvalidArgumentException("Username does not exist"));
		}

		//get the Activation Token
		$userActivationToken = User::getUserActivationToken();

		//if they have an activation token, the account is not activated yet
		if($userActivationToken !== null) {
			throw(new \InvalidArgumentException("Account has not been activated yet, please activate"));
		}

		//get the hash
		$hash =  hash_pbkdf2("sha512", $password, $user->getUserSalt(), 262144);

		//check the hash against inputted data-- no match, throw exception
		if($hash !== $user->getUserHash()) {
			throw(new \InvalidArgumentException("Username or password is incorrect"));
		}

		$_SESSION["user"] = $foundUser;
		$reply->message = "Successfully logged in!";

	} else {
		throw (new \InvalidArgumentException("Invalid HTTP method request"));
	}

} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
	$reply->trace = $exception->getTraceAsString();
} catch(TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}