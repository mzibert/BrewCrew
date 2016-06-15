/**
app.controller('SignoutController', ["$scope", "SignoutService", function($scope,  SignoutService) {
	SignoutService.signout()
		.then(function() {
			$scope.signoutData = [];
			$scope.alerts = [];
		});
}]);

