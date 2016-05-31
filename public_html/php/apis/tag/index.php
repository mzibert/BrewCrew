<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoloader.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\BrewCrew;


/**
 * API for the Tag class
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

try {
	// Grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/brewcrew.ini");

	// Determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	// Sanitize input
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	// Make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}

	// Sanitize and trim the other input
	$tagLabel = filter_input(INPUT_GET, "tagLabel", FILTER_SANITIZE_STRING);

	// Handle all restful calls
	if($method === "GET") {
		// Set XSRF cookie
		setXsrfCookie("/");

		// Get a specific tag or all tags and update reply
		if(empty($id) === false) {
			$tag = Edu\Cnm\BrewCrew\Tag::getTagByTagId($pdo, $id);
			if($tag !== null) {
				$reply->data = $tag;
			}
		}  else {
			$tags = Edu\Cnm\BrewCrew\Tag::getAllTags($pdo);
			if($tags !== null) {
				$reply->data = $tags;
			}
		}

		// PUT and POST
	} else if($method === "PUT" || $method === "POST") {

		// Set XSRF cookie
		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		// Make sure tag content is available
		if(empty($requestObject->tagLabel) === true) {
			throw(new InvalidArgumentException ("Tag label cannot be empty", 405));
		}

		// Perform the actual put or post
		if($method === "PUT") {

			// Retrieve the tag to update
			$tag = BrewCrew\Tag::getTagByTagId($pdo, $id);
			if($tag === null) {
				throw(new RuntimeException("Tag does not exist", 404));
			}

			// Put the new tag content into the tag and update
			$tag->setTagLabel($requestObject->tagLabel);
			$tag->update($pdo);

			// Update reply
			$reply->message = "Tag updated";

		} else if($method === "POST") {

			//  Make sure tagId is available
			if(empty($requestObject->tagId) === true) {
				throw(new \InvalidArgumentException ("No tag id", 405));
			}

			// Create new tag and insert into the database
			$tag = new BrewCrew\Tag(null, $requestObject->tagLabel);
			$tag->insert($pdo);

			// Update reply
			$reply->message = "Tag created";
		}

	} else if($method === "DELETE") {
		verifyXsrf();

		// Retrieve the tag to be deleted
		$tag = BrewCrew\Tag::getTagByTagId($pdo, $id);
		if($tag === null) {
			throw(new RuntimeException("Tag does not exist", 404));
		}

		// Delete tag
		$tag->delete($pdo);
		$deletedObject = new stdClass();


		// Update reply
		$reply->message = "Tag deleted OK";
	} else {
		throw (new InvalidArgumentException("Invalid HTTP method request"));
	}

	// Update reply with exception information
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

// Encode and return reply to front end caller
echo json_encode($reply);