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
	$breweryId = filter_input(INPUT_GET, "breweryId", FILTER_VALIDATE_INT);
	$userId = filter_input(INPUT_GET, "userId", FILTER_VALIDATE_INT);
	$beerId = filter_input(INPUT_GET, "beerId", FILTER_VALIDATE_INT);
	$reviewPintRating = filter_input(INPUT_GET, "reviewPintRating", FILTER_VALIDATE_INT);
	

	//make sure the id is valid for methods that require it
	if(($method === "DELETE") && (empty($reviewId) === true || $reviewId < 0)) {
		throw(new \InvalidArgumentException("id cannot be empty or negative", 405));
	}

	//handle GET request - if id is present, then the review is returned, otherwise all reviews are returned
	if($method == "GET") {
		//set XSRF cookie
		setXsrfCookie();
		
		//get methods:get a specific review by reviewId, get reviews by beerId, by userId, by breweryId, and by pintRating
		if(empty($reviewId) === false) {
			$review = BrewCrew\Review::getReviewByReviewId($pdo, $reviewId);
			if($review !== null) {
				$reply->data = $review;
			}
		} else if(empty($beerId) === false) {
			$review = BrewCrew\Review::getReviewByBeerId($pdo, $review);
			if($review !== null) {
				$reply->data = $review;
			}
		} else if(empty($userId) === false) {
			$review = BrewCrew\Review::getReviewByUserId($pdo, $review);
			if($review !== null) {
				$reply->data = $review;
			}
		}else if(empty($breweryId) === false) {
			$review = BrewCrew\Review::getReviewByBreweryId($pdo, $breweryId);
			if($review !== null) {
				$reply->data = $review;
			}
		}else if(empty($reviewPintRating) === false) {
			$review = BrewCrew\Review:: getReviewByReviewPintRating($pdo, $breweryId);
			if($review !== null) {
				$reply->data = $review;
			}
		}
	} else if($method === "POST") {
		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//make sure that content is available
		if(empty($requestObject->reviewPintRating) === true) {
			throw(new \InvalidArgumentException ("No pint rating for the review.", 405));
		}
	}
	//perform the actual POST
	if($method === "POST") {
		//make sure that the userId if available
		if(empty($requestObject->userId) === true) {
			throw(new \InvalidArgumentException ("No associated user ID.", 405));
		}
		//create new review and insert it into the database
		$review = new BrewCrew\Review
	}



}