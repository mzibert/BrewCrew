app.controller('SignoutController', ["$scope", "$window", "SignoutService", function($scope, $window, signoutService) {
	SignoutService.signout()
		.then(function() {
			$window.location = ".";
		});
}]);