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

if($method === "GET"){
	if(session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}
	$_SESSION = [];
	//ToDo send user somewhere
}

