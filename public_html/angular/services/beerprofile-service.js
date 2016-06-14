/**
 *
 */

app.constant("BEERPROFILE_ENDPOINT", "php/apis/beer/");
app.service("BeerProfileService", function($http, BEERPROFILE_ENDPOINT) {

	function getUrl() {
		return(BEERPROFILE_ENDPOINT);
	}

	function getUrlForId(beerId) {
		return(getUrl() + beerId);
	}

	this.all = function() {
		return($http.get(getUrl()));
	};

	this.fetch = function(beerId) {
		return($http.get(getUrlForId(beerId)));
	};

});