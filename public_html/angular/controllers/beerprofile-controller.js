app.controller("BeerProfileController", ["$routeParams", "$scope", "BeerService", function($routeParams, $scope, BeerService) {
	$scope.beerProfile = null;
	$scope.alerts = [];
	$scope.beerData = [];

	$scope.loadBeerProfile = function() {
		BeerService.fetchBeerById($routeParams.id)
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.beerProfile = result.data.data;
					console.log($scope.beerProfile);
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			});
	};

	if ($scope.beerProfile === null) {
		$scope.loadBeerProfile();
	}
}]);