// configure our routes
app.config(function($routeProvider, $locationProvider) {
	$routeProvider

	// route for the home page
		.when('/', {
			controller  : 'indexController',
			templateUrl : 'angular/pages/index.php'
		})

		// route for the sign in page
		.when('/signin', {
			controller  : 'signinController',
			templateUrl : 'angular/pages/signin.php'
		})

		// route for the sign up page
		.when('/signup', {
			controller  : 'signupController',
			templateUrl : 'angular/pages/signup.php'
		})
		// route for the the compasss page
		.when('/thecompass', {
			controller  : 'thecompassController',
			templateUrl : 'angular/pages/thecompass.php'
		})

		// route for the breweries page
		.when('/breweries', {
			controller  : 'breweriesController',
			templateUrl : 'angular/pages/breweries.php'
		})

		// route for the beer page
		.when('/beer', {
			controller  : 'beerController',
			templateUrl : 'angular/pages/beer.php'
		})

		// route for the contact page
		.when('/contact', {
			controller  : 'contactController',
			templateUrl : 'angular/pages/contact.php'
		})

		// otherwise redirect to home
		.otherwise({
			redirectTo: "/"
		});

	//use the HTML5 History API
	$locationProvider.html5Mode(true);
});
