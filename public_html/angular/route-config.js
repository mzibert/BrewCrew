// configure our routes
app.config(function($routeProvider, $locationProvider) {
	$routeProvider

	// route for the home page
		.when('/', {
			controller  : 'homeController',
			templateUrl : 'angular/templates/home.php'
		})

		// route for the sign in page
		.when('/signin/', {
			controller  : 'signinController',
			templateUrl : 'angular/templates/signin.php'
		})

		// route for the sign up page
		.when('/signup/', {
			controller  : 'signupController',
			templateUrl : 'angular/templates/signup.php'
		})

		// route for the the compasss page
		.when('/thecompass/', {
			controller  : 'thecompassController',
			templateUrl : 'angular/templates/compass.php'
		})

		// route for the breweries page
		.when('/breweries/', {
			controller  : 'breweriesController',
			templateUrl : 'angular/templates/breweries.php'
		})

		// route for the beer page
		.when('/beer/', {
			controller  : 'beerController',
			templateUrl : 'angular/templates/beer.php'
		})

		// otherwise redirect to home
		.otherwise({
			redirectTo: "/"
		});

	//use the HTML5 History API
	$locationProvider.html5Mode(true);
});
