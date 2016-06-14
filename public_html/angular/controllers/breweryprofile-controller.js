app.controller("BreweryProfileController", ["$routeParams", "$scope", "$window", "BreweryProfileService", "location", function($routeParams, $scope, $window, BreweryProfileService, $location) {
	$scope.breweryProfile = null;
	$scope.alerts = [];
	$scope.breweryData = [];

	$scope.loadBreweryProfile = function() {
		BreweryProfileService.fetch($routeParams.id)
			console.log(BreweryProfileService)
			.then(function(result) {
				console.log(result);
				if(result.data.status === 200) {
					$scope.breweryprofile = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
				return BreweryProfileService;
			});
	};
	$scope.loadBreweryById = function() {
			BreweryProfileService.fetch($routeParams.id)
				console.log(BreweryProfileService)
				BreweryProfileService.loadBreweryProfile()
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.breweryData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
				return BreweryById;
			})
	};
}]);