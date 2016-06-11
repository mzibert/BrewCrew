/**
 * 
 */

app.constant("BREWERY_ENDPOINT", "php/apis/brewery/");
app.service("breweryService", function($http, BREWERY_ENDPOINT) {

	function getUrl() {
		return(BREWERY_ENDPOINT);
	}

	function getUrlForId(breweryId) {
		return(getUrl() + breweryId);
	}

	this.all = function() {
		return($http.get(getUrl()));
	};

	this.fetchBreweryById = function(breweryId) {
		return($http.get(getUrlForId() + breweryId));
	};

	this.fetchBreweryByLocation = function(breweryLocation) {
		return($http.get(getUrl() + "?breweryLocation=" + breweryLocation));
	};

	this.fetchBreweryByName = function(breweryName) {
		return($http.get(getUrl() + "?breweryName=" + breweryName));
	};


	this.update = function(breweryId, brewery) {
		return($http.put(getUrlForId(breweryId, brewery)));
	};

	this.create = function(brewery) {
		return($http.post(getUrl(), brewery));
	};

	this.destroy = function(breweryId) {
		return($http.delete(getUrlForId(breweryId)));
	};
});

