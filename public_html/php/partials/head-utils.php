<!DOCTYPE html>
<html lang="en" ng-app="NgTemplate">
	<head>
		<!-- The 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<!-- set base for relative links - to enable pretty URLs -->
		<base href="<?php echo dirname($_SERVER["PHP_SELF"]) . "/";?>">

		<!-- Latest compiled and minified Bootstrap CSS -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- Optional Bootstrap theme -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

		<!--FontAweseom-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


		<link rel="stylesheet" href="css/style.css" type="text/css"/>

		<!--Angular JS Libraries-->
		<?php $ANGULAR_VERSION = "1.5.6";?>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION;?>/angular.min.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION;?>/angular-messages.min.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION;?>/angular-route.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION;?>/angular-animate.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/1.3.3/ui-bootstrap-tpls.min.js"></script>

		<!-- Angular JS App Files -->
		<script type="text/javascript" src="angular/app.js"></script>
		<script type="text/javascript" src="angular/route-config.js"></script>
		<script type="text/javascript" src="angular/directives/bootstrap-breakpoint.js"></script>
		<script type="text/javascript" src="angular/controllers/home-controller.js"></script>
		<script type="text/javascript" src="angular/controllers/nav-controller.js"></script>
		<script type="text/javascript" src="angular/controllers/about-controller.js"></script>
		<script type="text/javascript" src="angular/controllers/signup-controller.js"></script>
		<script type="text/javascript" src="angular/controllers/toys-controller.js"></script>
		<script type="text/javascript" src="angular/controllers/treats-controller.js"></script>

		<title>Meow Template!</title>
	</head>