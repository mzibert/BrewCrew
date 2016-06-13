app.controller('BeerController', ["$scope", "BeerService", function($scope, BeerService) {
	$scope.alerts = [];
	$scope.beerData = [];


	$scope.getBeerById = function(beerId) {
		BeerService.fetchBeerById(beerId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.beerData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};


	$scope.getBeerByBreweryId = function(breweryId) {
		BeerService.fetchBeerByBreweryId(breweryId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.beerData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getBeerByIbu = function(beerIbu) {
		BeerService.fetchBeerByIbu(beerIbu)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.beerData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getBeerByColor = function(beerColor) {
		BeerService.fetchBeerByColor(beerColor)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.beerData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getBeerByName = function(beerName) {
		console.log("in getbeerbyname");
		BeerService.fetchBeerByName(beerName)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.beerData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};



/**
 * Creates a beer and sends it to the beer API
 *
 * @param beer the beer we send
 * @param validated true if Angular validated the form, false if not
 **/
	$scope.beerCreate = function(beer, validated) {
		if(validated === true) {
			BeerService.create(beer)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		}};

/** Updates a beer and sends it to the beer database
 *
 *@param beer the beer we are sending
 *@param validated true if Angular validated the form, false if not
 **/
	$scope.beerUpdate = function(beer, validated) {
		if (validated === true) {
			BeerService.update(beer)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		}};
	/**
	 * Destroys a beer and removes it from the beer API
	 *
	 * @param beer the beer we send
	 * @param validated true if Angular validated the form, false if not
	 **/
	$scope.destroy = function(beer, validated) {
		if(validated === true) {
			BeerService.destroy(beer)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		}};

}]);