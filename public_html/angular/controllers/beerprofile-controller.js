app.controller("BeerProfileController", ["$routeParams", "$scope", "$uibModal", "$window", "BeerProfileService", function($routeParams, $scope, $uibModal, $window, BeerProfileService) {
	$scope.deletedBeerProfile = false;
	$scope.beerprofile = null;
	$scope.alerts = [];
	$scope.beerData = [];

	$scope.getBeerProfile = function() {
		BeerProfileService.fetch($routeParams.id)
			.then(function(result) {
				if(result.data.status === 200) {
					if(result.data.data !== undefined) {
						$scope.beerprofile = result.data.data;
						$scope.deletedBeerprofile = false;
					} else {
						$scope.alerts[0] = {type: "warning", msg: "Beerprofile " + $routeParams.id + " has been deleted"};
						$scope.deletedBeerprofile = true;
					}
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			});
	};