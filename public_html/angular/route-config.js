// configure our routes
app.config(function($routeProvider, $locationProvider) {
	$routeProvider

	// route for the home page
		.when('/', {
			controller  : 'homeController',
			templateUrl : 'angular/template/home.php'
		})

		// route for the sign in page
		.when('/signin', {
			controller  : 'signinController',
			templateUrl : 'angular/template/signin.php'
		})

		// route for the sign up page
		.when('/signup', {
			controller  : 'signupController',
			templateUrl : 'angular/template/signup.php'
		})
		// route for the sign up page
		.when('/signout', {
			controller  : 'signoutController',
			templateUrl : 'angular/template/signout.php'
		})
		// route for the the compasss page
		.when('/thecompass', {
			controller  : 'thecompassController',
			templateUrl : 'angular/template/thecompass.php'
		})

		// route for the breweries page
		.when('/breweries', {
			controller  : 'breweriesController',
			templateUrl : 'angular/template/breweries.php'
		})

		// route for the beer page
		.when('/beer', {
			controller  : 'beerController',
			templateUrl : 'angular/template/beer.php'
		})

		// otherwise redirect to home
		.otherwise({
			redirectTo: "/"
		});

	//use the HTML5 History API
	$locationProvider.html5Mode(true);
});
