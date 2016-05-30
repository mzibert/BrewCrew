<?php

require_once dirname(dirname(_DIR_)) . "/classes/autoloader.php";
require_once dirname(dirname(_DIR_)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

/**
 * controller/api for activation token
 *
 * @author Arlene Carol Graham
 */


//verify the xsrf challenge

if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare a empty reply

$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {

//Grab MySQL connection

	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/brewcrew.ini");

//determine which http method was used

	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] :$_SERVER["REQUEST_METHOD"];

//handle REST calls, while allowing administrators to access database modifying methods

	if($method === "GET") {

//set Xsrf cookie

		setXsrfcookie("/");

//get the Sign Up based on the given field

		$emailActivationToken = filter_input(INPUT_GET, "emailActivationToken", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		if(empty($emailActivationToken)) {
			throw(new \RangeException ("No ActivationToken Code"));
		}

		$user = User::getUserByUserActivationToken($pdo, $emailActivationToken);

		if(empty($user)) {
			throw(new \InvalidArgumentException ("no user for activation token"));
		}

		$user->setUserActivationToken(null);
		$user->update($pdo);

		header("Location: ../../../");
	} else {

		throw(new \Exception("Invalid HTTP method"));
	}

} catch(Exception $exception) {

	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
	$reply->trace = $exception->getTraceAsString();

	header("Content-type: application/json");

	echo json_encode($reply);

} catch(\TypeError $typeError) {

	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
	$reply->trace = $typeError->getTraceAsString();

	header("Content-type: application/json");

	echo json_encode($reply);
}
