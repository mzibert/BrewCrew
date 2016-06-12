app.controller('SignoutController', ["$scope", "$window", "SignoutService", function($scope, $window, SignoutService) {
	SignoutService.signout()
		.then(function() {
			$window.location = ".";
		});
}]);

