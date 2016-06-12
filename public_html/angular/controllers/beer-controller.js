app.controller('beerController', ["$scope", "beerservice", function($scope, beerService) {


	$scope.getBeerById = function() {
		beerService.fetchBeerById(beerId)
			.then(function(result) {

				
			})
		
	}

});

	$scope.getBeerByBreweryId = function() {
		beerService.fetchBeerByBreweryId(breweryId)
			.then(function(result) {


			})

	}

});

	$scope.getBeerByIbu = function() {
		beerService.fetchBeerByIbu(beerIbu)
			.then(function(result) {


		})

}

});

	$scope.getBeerByColor = function() {
		beerService.fetchBeerByColor(beerColor)
			.then(function(result) {


		})

}

});

	$scope.getBeerByName = function() {
		beerService.fetchBeerByName(beerName)
			.then(function(result) {


		})

}

});

$scope.getBeerByColor = function() {
	beerService.fetchBeerByColor(beerColor)
		.then(function(result) {


		})

}

});

/**Do we need all beers???
 **/

