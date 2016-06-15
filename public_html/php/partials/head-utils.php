<?php

require_once(dirname(__DIR__) . "/lib/xsrf.php");
//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
session_start();
}
setXsrfCookie();

?>



<!DOCTYPE html>
<html lang="en" ng-app="BrewCrew">
	<head>
		<meta charset="UTF-8">
		<!-- sets IE rendering to IE-EDGE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- sets viewport width to device width, scaling 1:1 -->
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<base href="<?php echo dirname($_SERVER["PHP_SELF"]) . "/"; ?>">


		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
				integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Viga" rel="stylesheet">



		<!-- HTML5 shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!--FontAweseom-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


		<link rel="stylesheet" href="css/style.css" type="text/css"/>

		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-2.2.3.min.js"
				  integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
				  integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
				  crossorigin="anonymous"></script>

		<!--Angular JS Libraries-->
		<?php $ANGULAR_VERSION = "1.5.6"; ?>
		<script type="text/javascript"
				  src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION; ?>/angular.min.js"></script>
		<script type="text/javascript"
				  src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION; ?>/angular-messages.min.js"></script>
		<script type="text/javascript"
				  src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION; ?>/angular-route.js"></script>
		<script type="text/javascript"
				  src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION; ?>/angular-animate.js"></script>
		<script type="text/javascript"
				  src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/1.3.3/ui-bootstrap-tpls.min.js"></script>


		<script type="text/javascript" src="angular/app.js"></script>
		<script type="text/javascript" src="angular/route-config.js"></script>
		<!-- Angular JS App Files -->
		<script type="text/javascript" src="angular/services/beer-service.js"></script>
		<script type="text/javascript" src="angular/services/beerprofile-service.js"></script>
		<script type="text/javascript" src="angular/services/brewery-service.js"></script>
		<script type="text/javascript" src="angular/services/breweryprofile-service.js"></script>

		<!--		<script type="text/javascript" src="angular/services/home-service.js"></script>-->
		<script type="text/javascript" src="angular/services/review-service.js"></script>
		<script type="text/javascript" src="angular/services/signin-service.js"></script>
<!--		<script type="text/javascript" src="angular/services/signout-service.js"></script>-->
		<script type="text/javascript" src="angular/services/signup-service.js"></script>
		<script type="text/javascript" src="angular/services/user-service.js"></script>

		<script type="text/javascript" src="angular/directives/bootstrap-breakpoint.js"></script>
		
		<script type="text/javascript" src="angular/controllers/home-controller.js"></script>
		<script type="text/javascript" src="angular/controllers/nav-controller.js"></script>
		<script type="text/javascript" src="angular/controllers/beer-controller.js"></script>
		<script type="text/javascript" src="angular/controllers/beerprofile-controller.js"></script>
		<script type="text/javascript" src="angular/controllers/brewery-controller.js"></script>
		<script type="text/javascript" src="angular/controllers/breweryprofile-controller.js"></script>
		<script type="text/javascript" src="angular/controllers/review-controller.js"></script>
		<script type="text/javascript" src="angular/controllers/signin-controller.js"></script>
<!--		<script type="text/javascript" src="angular/controllers/signout-controller.js"></script>-->
		<script type="text/javascript" src="angular/controllers/signup-controller.js"></script>
		<script type="text/javascript" src="angular/controllers/user-controller.js"></script>

		
		
		<title>ABQ Brew Crew</title>
	</head>