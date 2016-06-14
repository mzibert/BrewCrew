app.controller('LogoutController', ["$scope", "LogoutService", function($scope,  LogoutService) {
	LogoutService.logout()
		.then(function() {
			$window.location = ".";
		});
}]);

