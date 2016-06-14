app.controller("BreweryProfileController", ["$routeParams", "$scope", "BreweryProfileService", "BeerService", function($routeParams, $scope, BreweryProfileService, BeerService) {
	$scope.breweryProfile = null;
	$scope.alerts = [];
	$scope.breweryData = [];
	$scope.beerData = [];

	$scope.loadBreweryProfile = function() {
		BreweryProfileService.fetch($routeParams.id)
			// console.log(BreweryProfileService)
			.then(function(result) {
				console.log(result);
				if(result.data.status === 200) {
					$scope.breweryProfile = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
				
				BeerService.fetchBeerByBreweryId($routeParams.id)
					.then(function(result) {
						console.log(result);
						$scope.beerData = result.data.data;
						console.log($scope.beerData);

					})
			});
	};


	if ($scope.breweryProfile === null) {
		$scope.loadBreweryProfile();
	}

}]);