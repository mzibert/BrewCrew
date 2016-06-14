app.controller("BreweryProfileController", ["$routeParams", "$scope", "BreweryProfileService", function($routeParams, $scope, BreweryProfileService) {
	$scope.breweryProfile = null;
	$scope.alerts = [];
	$scope.breweryData = [];

	$scope.getBreweryProfile = function() {
		BreweryProfileService.fetch($routeParams.id)
			.then(function(result) {
				console.log(result);
				if(result.data.status === 200) {
					if(result.data.data !== undefined) {
						$scope.breweryprofile = result.data.data;
						$scope.deletedBreweryprofile = false;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			});
	};
	$scope.getBreweryById = function(breweryId) {
			BreweryProfileService.fetch($routeParams.id)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.breweryData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};
}]);