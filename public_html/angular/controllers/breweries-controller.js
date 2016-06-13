app.controller('BreweriesController', ["$scope", "BreweriesService", function($scope, BreweriesService) {
	$scope.alerts = [];
	$scope.breweriesData = [];
	$scope.getBreweryById = function() {
		BreweriesService.fetchBreweryById(breweryId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.breweriesData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};
	$scope.getBreweryByBreweryId = function() {
		BreweriesService.fetchBreweryByBreweryId(breweryId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.breweriesData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};
	$scope.getBreweryByLocation = function() {
		BreweriesService.fetchBreweryByLocation(breweryLocation)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.breweriesData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};
	$scope.getBreweryByName = function() {
		BreweriesService.fetchBreweryByName(breweryName)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.breweriesData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};
	/** 
	 * Updates a brewery and sends it to the brewery database
	 *
	 *@param brewery the brewery we are sending
	 *@param validated true if Angular validated the form, false if not
	 **/
	$scope.update = function(brewery, validated) {
		if (validated === true) {
			BreweriesService.create(brewery)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		}};
}]);
	/**
	 * Creates a brewery and sends it to the brewery API
	 *
	 * @param brewery the brewery we are sending
	 * @param validated true if Angular validated the form, false if not
	 **/
	$scope.create = function(brewery, validated) {
		if(validated === true) {
			BreweriesService.create(brewery)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		}};
/**
 * Destroys a brewery and removes it from the brewery API
 *
 * @param brewery the brewery we send
 * @param validated true if Angular validated the form, false if not
 **/
$scope.create = function(brewery, validated) {
	if(validated === true) {
		BreweriesService.destroy(brewery)
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.alerts[0] = {type: "success", msg: result.data.message};
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	}};
