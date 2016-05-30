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

	//perform the actual POST
	if($method === "POST") {

		// convert JSON to an object
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//sanitize the email & search for user by email
		$userEmail = filter_var($requestObject->userEmail, FILTER_SANITIZE_EMAIL);
		$user = User::getUserbyUserEmail($pdo, $userEmail);
		



	}


}