<?php

require_once dirname(__DIR__, 2) . "/classes/autoload.php";
require_once dirname(__DIR__, 2) . "/lib/xsrf.php";
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


	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	$breweryId = filter_input(INPUT_GET, "breweryId", FILTER_VALIDATE_INT);
	$reviewUserId = filter_input(INPUT_GET, "reviewUserId", FILTER_VALIDATE_INT);
	$reviewBeerId = filter_input(INPUT_GET, "reviewBeerId", FILTER_VALIDATE_INT);
	$reviewPintRating = filter_input(INPUT_GET, "reviewPintRating", FILTER_VALIDATE_INT);
	$reviewText = filter_input(INPUT_GET, "reviewText", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);


	//handle GET request - if id is present, then the review is returned, otherwise all reviews are returned
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get methods:get a specific review by reviewId, get reviews by beerId, by userId, by breweryId, and by pintRating
		if(empty($id) === false) {
			$review = BrewCrew\Review::getReviewByReviewId($pdo, $id);
			if($review !== null) {
				$reviewTags = BrewCrew\ReviewTag::getReviewTagByReviewId($pdo, $review->getReviewId());
				$storage = new BrewCrew\JsonObjectStorage();
				$storage->attach($review, $reviewTags->toArray());
				$reply->data = $storage;
			}
		} else if(empty($reviewBeerId) === false) {
			$reviews = BrewCrew\Review::getReviewByBeerId($pdo, $reviewBeerId);
			if($reviews !== null) {
				$storage = new BrewCrew\JsonObjectStorage();
				foreach($reviews as $review) {
					$reviewTags = BrewCrew\ReviewTag::getReviewTagByReviewId($pdo, $review->getReviewId());
					$storage->attach($review, $reviewTags->toArray());
					$reply->data = $storage;
				}
			}
		} else if(empty($reviewUserId) === false) {
			$reviews = BrewCrew\Review::getReviewByUserId($pdo, $reviewUserId);
			if($reviews !== null) {
				$storage = new BrewCrew\JsonObjectStorage();
				foreach($reviews as $review) {
					$reviewTags = BrewCrew\ReviewTag::getReviewTagByReviewId($pdo, $review->getReviewId());
					$storage->attach($review, $reviewTags->toArray());
					$reply->data = $storage;
				}
			}
		} else if(empty($breweryId) === false) {
			$reviews = BrewCrew\Review::getReviewByBreweryId($pdo, $breweryId);
			if($reviews !== null) {
				$storage = new BrewCrew\JsonObjectStorage();
				foreach($reviews as $review) {
					$reviewTags = BrewCrew\ReviewTag::getReviewTagByReviewId($pdo, $review->getReviewId());
					$storage->attach($review, $reviewTags->toArray());
					$reply->data = $storage;
				}
			}
		} else if(empty($reviewPintRating) === false) {
			$reviews = BrewCrew\Review::getReviewByReviewPintRating($pdo, $reviewPintRating)->toArray();
			if($reviews !== null) {
				$storage = new BrewCrew\JsonObjectStorage();
				foreach($reviews as $review) {
					$reviewTags = BrewCrew\ReviewTag::getReviewTagByReviewId($pdo, $review->getReviewId());
					$storage->attach($review, $reviewTags->toArray());
					$reply->data = $storage;
				}
			}
		}
	} else if($method === "POST") {

		if(empty($_SESSION["user"]) === true) {
			setXsrfCookie("/");
			throw(new \RuntimeException("Not logged in. Please log-in or sign-up."));
		} else if(empty ($_SESSION["user"]) !== false) {
			verifyXsrf();
			// convert JSON to an object
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
			//perform the actual POST
			//create new review and insert it into the database
			$review = new BrewCrew\Review(null, $requestObject->reviewBeerId, $_SESSION["user"]->getUserId(), $requestObject->reviewDate, $requestObject->reviewPintRating, $requestObject->reviewText);
			$review->insert($pdo);
			$reply->message = "Review has been created";

			//add tags
			foreach($requestObject->reviewTagIds as $tagId) {
				$reviewTag = new ReviewTag($review->getReviewId(), $tagId);
				$reviewTag->insert($pdo);
			}
		}
		var_dump($_SESSION["user"]);
		var_dump($review);
	} else {
		throw (new InvalidArgumentException("Invalid HTTP method request"));
	}
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

// encode and return reply to front end caller
echo json_encode($reply);