<?php>
/**
 * GET all beers
 * GET a specific beer by primary key
 * GET beers by brewery Id
 * GET beer by IBU
 * GET beer by beer color
 * GET beer by beer name
 * GET beer by style
 * POST create a brand new beer
 * PUT update beer
 * DELETE a beer
 **/
require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\BrewCrew;

/**
 * api for the beer class
 *
 * @author Merri J. Zibert <mjzibert2@gmail.com>
 */

//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}
//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try{
	//grab the mySQL connection
	$pdo = ConnectToEncryptedMySQL("/etc/apache2/capstone-mysql/brewcrew.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//Sanitize input
	
}

