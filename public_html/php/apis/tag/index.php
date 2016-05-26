<?php

require_once "autoloader.php";
require_once "/lib/xsrf.php";
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
	$tagId = filter_input(INPUT_GET, "tagId", FILTER_VALIDATE_INT);

	// Make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($tagId) === true || $tagId < 0)) {
		throw(new InvalidArgumentException("Tag id cannot be empty or negative", 405));
	}
	// Handle GET request - if tagId is present, that tag is returned, otherwise all tags are returned
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		// Get a specific tag or all tags and update reply
		if(empty($tagId) === false) {
			$tag = Edu\Cnm\BrewCrew\Tag::getTagByTagId($pdo, $tagId);
			if($tag !== null) {
				$reply->data = $tag;
			}
		}  else {
			$tags = Edu\Cnm\BrewCrew\Tag::getAllTags($pdo);
			if($tags !== null) {
				$reply->data = $tags;
			}
		}

	} else if($method === "PUT" || $method === "POST") {

		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		// Make sure tag content is available
		if(empty($requestObject->tagContent) === true) {
			throw(new \InvalidArgumentException ("No content for Tag.", 405));
		}

		// Perform the actual put or post
		if($method === "PUT") {

			// Retrieve the tag to update
			$tag = Edu\Cnm\BrewCrew\Tag::getTagByTagId($pdo, $tagId);
			if($tag === null) {
				throw(new RuntimeException("Tag does not exist", 404));
			}

			// Put the new tag content into the tag and update
			$tag->setTagContent($requestObject->tagContent);
			$tag->update($pdo);

			// Update reply
			$reply->message = "Tag updated OK";

		} else if($method === "POST") {

			//  Make sure tagId is available
			if(empty($requestObject->tagId) === true) {
				throw(new \InvalidArgumentException ("No Tag ID.", 405));
			}

			// Create new tag and insert into the database
			$tag = new Edu\Cnm\BrewCrew\Tag(null, $requestObject->tagId, $requestObject->tagContent, null);
			$tag->insert($pdo);

			// Update reply
			$reply->message = "Tag created OK";
		}

	} else if($method === "DELETE") {
		verifyXsrf();

		// Retrieve the Tag to be deleted
		$tag = Edu\Cnm\BrewCrew\Tag::getTagByTagId($pdo, $tagId);
		if($tag === null) {
			throw(new RuntimeException("Tag does not exist", 404));
		}

		// Delete tag
		$tag->delete($pdo);

		// Update reply
		$reply->message = "Tag deleted OK";
	} else {
		throw (new InvalidArgumentException("Invalid HTTP method request"));
	}

	// Update reply with exception information
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

// Encode and return reply to front end caller
echo json_encode($reply);