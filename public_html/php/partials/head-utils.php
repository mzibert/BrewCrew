
<!DOCTYPE html>
<html ng-app="BrewCrew">

<head>
	<meta charset="utf-8">


	<!-- The 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>

	<!-- set base for relative links - to enable pretty URLs -->
	<base href="<?php echo dirname($_SERVER["PHP_SELF"]) . "/";?>">
	<!-- Latest compiled and minified Bootstrap CSS -->

	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional Bootstrap theme -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous"



	<!--font awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro|Didact+Gothic|Bitter' rel='stylesheet'
			type='text/css'>
	<link href="css/style.css" rel="stylesheet" type="text/css">


	<!--Angular JS Libraries-->
	<?php $ANGULAR_VERSION = "1.5.5";?>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION;?>/angular.min.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION;?>/angular-messages.min.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION;?>/angular-route.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/1.3.3/ui-bootstrap-tpls.min.js"></script>



	<!-- Angular app files -->
	<script type="text/javascript" src="angular/app.js"></script>
	<script type="text/javascript" src="angular/route-config.js"></script>
	<script type="text/javascript" src="angular/controllers/beer-controller.js"></script>
	<script type="text/javascript" src="angular/controllers/breweries-controller.js"></script>
	<script type="text/javascript" src="angular/controllers/contact-controller.js"></script>
	<script type="text/javascript" src="angular/controllers/index-controller.js"></script>
	<script type="text/javascript" src="angular/controllers/signin-controller.js"></script>
	<script type="text/javascript" src="angular/controllers/signout-controller.js"></script>
	<script type="text/javascript" src="angular/controllers/signup-controller.js"></script>
	<script type="text/javascript" src="angular/controllers/thecompass-controller.js"></script>

	<title>ABQ Brew Crew</title>

</head>
