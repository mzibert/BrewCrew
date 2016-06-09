app.controller('signoutController', ["$scope", "$window", "SignoutService", function($scope, $window, signoutService) {
	SignoutService.signout()
		.then(function() {
			$window.location = ".";
		});
}]);