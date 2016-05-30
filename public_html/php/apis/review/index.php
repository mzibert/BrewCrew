<?php

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\BrewCrew;

/**
 *
 * api for the review class
 * allows for interacting with the backend
 * @author Alicia Broadhurst <abroadhurst@cnm.edu>
 */

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
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/brewcrew.ini");
	if(empty($_SESSION["user"]) === true) {
		setXsrfCookie("/");
		throw(new \RuntimeException("Not logged in. Please log-in or sign-up."));
	}

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$reviewId = filter_input(INPUT_GET, "reviewId", FILTER_VALIDATE_INT);
	$breweryId = filter_input(INPUT_GET, "breweryId", FILTER_VALIDATE_INT);
	$userId = filter_input(INPUT_GET, "userId", FILTER_VALIDATE_INT);
	$beerId = filter_input(INPUT_GET, "beerId", FILTER_VALIDATE_INT);
	$reviewPintRating = filter_input(INPUT_GET, "reviewPintRating", FILTER_VALIDATE_INT);
	$reviewText = filter_input(INPUT_GET, "reviewText", FILTER_SANITIZE_STRING);


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
			$review = BrewCrew\Review::getReviewByBeerId($pdo, $beerId);
			if($review !== null) {
				$reply->data = $review;
			}
		} else if(empty($userId) === false) {
			$review = BrewCrew\Review::getReviewByUserId($pdo, $userId);
			if($review !== null) {
				$reply->data = $review;
			}
		} else if(empty($breweryId) === false) {
			$review = BrewCrew\Review::getReviewByBreweryId($pdo, $breweryId);
			if($review !== null) {
				$reply->data = $review;
			}
		} else if(empty($reviewPintRating) === false) {
			$review = BrewCrew\Review:: getReviewByReviewPintRating($pdo, $reviewPintRating);
			if($review !== null) {
				$reply->data = $review;
			}
		}
	}
	if(empty ($_SESSION["user"]) !== false) {

		if($method === "POST") {
			verifyXsrf();
			$requestContent = file_get_contents("php://input");
			$requestObject = json_decode($requestContent);

			//make sure that content is available
			if(empty($requestObject->reviewBeerId) === true) {
				throw(new \InvalidArgumentException ("Review must have an associated beer", 405));
			}
			if(empty($requestObject->reviewUserId) === true) {
				throw(new \InvalidArgumentException("Review must be linked to a user", 405));
			}
			if(empty($requestObject->reviewPintRating) === true) {
				throw(new \InvalidArgumentException ("No pint rating for the review.", 405));
			}
			if(empty($requestObject->reviewDate) === true) {
				$requestObject->reviewDate = null;
			}
			if(empty($requestObject->reviewText) === true) {
				$requestObject->reviewText = null;
			}
		}
		//perform the actual POST
		if($method === "POST") {
			//create new review and insert it into the database
			$review = new BrewCrew\Review(null, $requestObject->beerId, $_SESSION["user"]->getUserId, $requestObject->reviewDate, $requestObject->reviewPintRating, $requestObject->reviewText);
		}
		$review->insert($pdo);
		$reply->message = "Review has been created";
		if($method === "POST") {
			//add tags
			foreach($tagIds as $tagId) {
				$reviewTag = new ReviewTag($reviewId, $tagId);
				$reviewTag->insert($pdo);
			}
		}

	}

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