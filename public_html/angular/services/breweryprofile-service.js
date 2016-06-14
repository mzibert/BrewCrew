/**
 *
 */

app.constant("BREWERYPROFILE_ENDPOINT", "php/apis/brewery/");
app.service("BreweryProfileService", function($http, BREWERYPROFILE_ENDPOINT) {

	function getUrl() {
		return(BREWERYPROFILE_ENDPOINT);
	}

	function getUrlForId(breweryId) {
		return(getUrl() + breweryId);
	}

	this.all = function() {
		return($http.get(getUrl()));
	};

	this.fetch = function(breweryId) {
		return($http.get(getUrlForId(breweryId)));
	};

});