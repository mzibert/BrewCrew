app.controller("BeerProfileController", ["$routeParams", "$scope", "BeerProfileService", function($routeParams, $scope, BeerProfileService) {
	$scope.beerProfile = null;
	$scope.alerts = [];
	$scope.beerData = [];

	$scope.loadBeerProfile = function() {
		BeerProfileService.fetch($routeParams.id)
			.then(function(result) {
				console.log(result);
				if(result.data.status === 200) {
					$scope.beerProfile = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			});
	};

	if ($scope.beerProfile === null) {
		$scope.loadBeerProfile();
	}
}]);