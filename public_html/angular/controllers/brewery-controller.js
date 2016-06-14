app.controller('BreweryController', ["$scope", "BreweryService", "$location", function($scope, BreweryService, $location) {
	$scope.breweryProfile = null;
	$scope.alerts = [];
	$scope.breweryData = [];
	// $scope.breweryId = $location.path;

	$scope.getBreweryById = function(breweryId) {
		BreweryService.fetchBreweryById(breweryId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.breweryData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};
	$scope.getBreweryByLocation = function(breweryLocation) {
		BreweryService.fetchBreweryByLocation(breweryLocation)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.breweryData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};
	$scope.getBreweryByName = function(breweryName) {
		console.log("in getbrewerybyname-Controller");
		console.log(breweryName);
		BreweryService.fetchBreweryByName(breweryName)
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.breweryData = result.data.data;
					console.log("good status");
					console.log(result.data.message);
					console.log(result.data.data);
					console.log($scope.breweryData);
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
					console.log("bad status");
					console.log(result.data.status);
					console.log(result.data.data);
					console.log(result.data.message);
				}
			})
	};
	/**
	 * onclick, reroutes page to the specified brewery
	 *
	 * @param breweryId the brewery we are sending
	 **/
	$scope.getBreweryProfile = function(breweryId) {
		$location.path = ("breweryprofile/" + breweryId);
	};
/**
	 * Creates a brewery and sends it to the brewery API
	 *
	 * @param brewery the brewery we are sending
	 * @param validated true if Angular validated the form, false if not
	 **/
	$scope.create = function(brewery, validated) {
		if(validated === true) {
			BreweryService.create(brewery)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		}};
/**
 * Updates a brewery and sends it to the brewery database
 *
 *@param brewery the brewery we are sending
 *@param validated true if Angular validated the form, false if not
 **/
$scope.update = function(brewery, validated) {
	if (validated === true) {
		BreweryService.update(brewery)
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.alerts[0] = {type: "success", msg: result.data.message};
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	}};
/**
/**
 * Destroys a brewery and removes it from the brewery API
 *
 * @param brewery the brewery we send
 * @param validated true if Angular validated the form, false if not
 **/
$scope.destroy = function(brewery, validated) {
	if(validated === true) {
		BreweryService.destroy(brewery)
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.alerts[0] = {type: "success", msg: result.data.message};
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	}};

}]);