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

/**
 * Creates a beer and sends it to the beer API
 *
 * @param beer the beer we send
 * @param validated true if Angular validated the form, false if not
 **/
	$scope.createBeer = function(beer, validated) {
		if(validated === true){
			beerservice.create(beer)
				.then(function(result) {
					if(result.data.status === 200){
						$scope.alerts[0] = {type: "success", msg: result.data.message};
						$scope.newBeer
					}
					
				})
		}
		
	}