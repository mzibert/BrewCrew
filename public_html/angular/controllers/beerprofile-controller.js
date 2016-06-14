app.controller("BeerProfileController", ["$routeParams", "$scope", "BeerProfileService", function($routeParams, $scope, BeerProfileService) {
	$scope.beerProfile = null;
	$scope.alerts = [];
	$scope.beerData = [];

	$scope.getBeerProfile = function() {
		BeerProfileService.fetch($routeParams.id)
			.then(function(result) {
				console.log(result);
				if(result.data.status === 200) {
					$scope.beerprofile = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
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