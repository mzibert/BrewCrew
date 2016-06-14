/**
 *
 */

app.constant("BEER_ENDPOINT", "php/apis/beer/");
app.service("BeerService", function($http, BEER_ENDPOINT) {

	function getUrl() {
		return(BEER_ENDPOINT);
	}

	function getUrlForId(beerId) {
		return(getUrl() + beerId);
	}

	this.all = function() {
		return($http.get(getUrl()));
	};

	// this.fetchBeerById = function(beerId) {
	// 	return($http.get(getUrlForId() + beerId));
	// };
	this.fetchBeerById = function(beerId) {
		return($http.get(getUrlForId(beerId)));
	};

	this.fetchBeerByBreweryId = function(beerBreweryId) {
		return($http.get(getUrl() + "?beerBreweryId=" + beerBreweryId));
	};

	this.fetchBeerByIbu = function(beerIbu) {
		return($http.get(getUrl() + "?beerIbu=" + beerIbu));
	};

	this.fetchBeerByColor = function(beerColor) {
		return($http.get(getUrl() + "?beerColor=" + beerColor));
	};

	this.fetchBeerByName = function(beerName) {
		console.log("in fetchbeerbyname: SERVICE");
		return($http.get(getUrl() + "?beerName=" + beerName));
	};

	this.fetchBeerByColor = function(beerColor) {
		return($http.get(getUrl() + "?beerColor=" + beerColor));
	};

	this.beerUpdate = function(beerId, beer) {
		return($http.put(getUrlForId(beerId, beer)));
	};

	this.beerCreate = function(beer) {
		return($http.post(getUrl(), beer));
	};

	this.beerDestroy = function(beerId) {
		return($http.delete(getUrlForId(beerId)));
	};
});

/**
 * 
 */
