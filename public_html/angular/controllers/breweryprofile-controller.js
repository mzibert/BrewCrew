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
				// return BreweryProfileService;
			});
	};
	// $scope.loadBreweryById = function() {
	// 		BreweryProfileService.fetch($routeParams.id)
	// 			console.log(BreweryProfileService)
	// 			BreweryProfileService.loadBreweryProfile()
	// 		.then(function(result) {
	// 			if(result.status.data === 200) {
	// 				$scope.breweryData = result.data.data;
	// 			} else {
	// 				$scope.alerts[0] = {type: "danger", msg: result.data.message};
	// 			}
	// 			return BreweryById;
	// 		})
	// };
	if ($scope.breweryProfile === null) {
		$scope.loadBreweryProfile();
	}
}]);