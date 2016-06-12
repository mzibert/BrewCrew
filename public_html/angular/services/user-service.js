app.constant("ACTIVATION_ENDPOINT", "php/api/user/");
app.service("UserService", function($http, ACTIVATION_ENDPOINT) {

	function getUrl() {
		return(ACTIVATION_ENDPOINT);
	}

	function getUrlForId(userId) {
		return(getUrl() + userId);
	}

	this.fetchUserByUserId = function(userId) {
		return($http.get(getUrlForId(userId)));
	};
	this.fetchUserByUserActivationToken = function(userActivationToken) {
		return($http.get(getUrl()+ "?userActivationToken=" + userActivationToken));
	};

	this.fetchUserByUserDateOfBirth = function(userDateOfBirth) {
		return($http.get(getUrl()+ "?userDateOfBirth=" + userDateOfBirth));
	};

	this.fetchUserByUserEmail = function(userEmail) {
		return($http.get(getUrl()+ "?userEmail=" + userEmail));
	};

	this.fetchUserByUserFirstName = function(userFirstName) {
		return($http.get(getUrl()+ "?userFirstName=" + userFirstName));
	};
	this.fetchUserByUserLastName = function(userLastName) {
		return($http.get(getUrl()+ "?userLastName=" + userLastName));
	};
	this.fetchUserByUserUsername = function(userUsername) {
		return($http.get(getUrl()+ "?userUsername=" + userUsername));
	};

	this.fetchAllUsers = function() {
		return($http.get(getUrl()));
	};

	this.update = function(userId, user) {
		return($http.put(getUrlForUserId(userId, user)));
	};

	this.create = function(user) {
		return($http.post(getUrl(), user));
	};

	this.destroy = function(userId) {
		return($http.delete(getUrlForUserId(userId)));
	}
});