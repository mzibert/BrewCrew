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
			controller  : 'SignupController',
			templateUrl : 'angular/templates/signup.php'
		})

		// route for the the compasss page
		.when('/thecompass/', {
			controller  : 'ThecompassController',
			templateUrl : 'angular/templates/thecompass.php'
		})

		// route for the breweries page
		.when('/breweries/', {
			controller  : 'BreweriesController',
			templateUrl : 'angular/templates/brewery.php'
		})

		// route for the beer page
		.when('/beer/', {
			controller  : 'BeerController',
			templateUrl : 'angular/templates/beer.php'
		})

		// route for the user page
		.when('/user/', {
			controller  : 'UserController',
			templateUrl : 'angular/templates/userProfile.php'
		})
			
		// route for the review page
		.when('/review/', {
			controller  : 'ReviewController',
			templateUrl : 'angular/templates/review.php'
		})



		// otherwise redirect to home
		.otherwise({
			redirectTo: "/"
		});

	//use the HTML5 History API
	$locationProvider.html5Mode(true);
});
