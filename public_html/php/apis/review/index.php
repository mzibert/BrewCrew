<?php

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\BrewCrew;

/**
 * api for the review class
 *
 * @author Alicia Broadhurst <abroadhurst@cnm.edu>
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
	$method = array_key_exists("HTTP_X_HTTP_METHOD",$_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$reviewId = filter_input(INPUT_GET, "reviewId", FILTER_VALIDATE_INT);

	//make sure the id is valid for methods that require it
	if(($method === "DELETE") && (empty($reviewId) === true || $reviewId < 0)) {
		throw(new \InvalidArgumentException("id cannot be empty or negative", 405));
	}

	//handle GET request - if id is present, then the review is returned, otherwise all reviews are returned
	if($method == "GET") {
		//set XSRF cookie
		setXsrfCookie();






}