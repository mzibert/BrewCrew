app.controller("BreweryProfileController", ["$routeParams", "$scope", "$uibModal", "$window", "BreweryProfileService", function($routeParams, $scope, $uibModal, $window, BreweryProfileService) {
	$scope.deletedBreweryProfile = false;
	$scope.breweryprofile = null;
	$scope.alerts = [];
	$scope.breweryData = [];

	$scope.getBreweryProfile = function() {
		BreweryProfileService.fetch($routeParams.id)
			.then(function(result) {
				if(result.data.status === 200) {
					if(result.data.data !== undefined) {
						$scope.breweryprofile = result.data.data;
						$scope.deletedBreweryprofile = false;
					} else {
						$scope.alerts[0] = {type: "warning", msg: "Breweryprofile " + $routeParams.id + " has been deleted"};
						$scope.deletedBreweryprofile = true;
					}
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			});
	};
}]);