app.controller("BeerProfileController", ["$routeParams", "$scope", "BeerService", "ReviewService", function($routeParams, $scope, BeerService, ReviewService) {

	$scope.beerProfile = null;
	$scope.alerts = [];
	$scope.beerData = [];
	$scope.reviewData = [];

	$scope.loadBeerProfile = function() {
		BeerService.fetchBeerById($routeParams.id)
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.beerProfile = result.data.data;
					console.log($scope.beerProfile);
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}

				ReviewService.fetchReviewByReviewBeerId($routeParams.id)
					.then(function(result) {
						 console.log($routeParams.id);
						$scope.reviewData = result.data.data;
						 console.log(result);
					})
			});
	};

	if ($scope.beerProfile === null) {
		$scope.loadBeerProfile();
	}

}]);