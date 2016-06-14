app.controller('LogoutController', ["$scope", "$window", "LogoutService", function($scope, $window, LogoutService) {
	LogoutService.logout()
		.then(function() {
			$window.location = ".";
		});
}]);

