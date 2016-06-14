app.controller("BreweryProfileController", ["$routeParams", "$scope", "BreweryProfileService", function($routeParams, $scope, BreweryProfileService) {
	$scope.breweryProfile = null;
	$scope.alerts = [];
	$scope.breweryData = [];

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
			});
	};

	if ($scope.breweryProfile === null) {
		$scope.loadBreweryProfile();
	}
}]);