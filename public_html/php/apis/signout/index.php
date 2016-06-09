<?php

require_once dirname(__DIR__, 2) . "/classes/autoload.php";
require_once dirname(__DIR__, 2) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\BrewCrew;


/**
 * api for signout
 *
 * @author Merri J Zibert <mjzibert2@gmail.com>
 **/

//prepare default error message
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/brewcrew.ini");


	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];


if($method === "GET"){
	if(session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}
	$_SESSION = [];
	//ToDo send user somewhere
}

