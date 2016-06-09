app.service('signoutService', function($http){
	this.SIGNOUT_ENDPOINT = 'php/api/signout/';

	this.logout = function() {
		return($http.get(this.SIGNOUT_ENDPOINT));
	};
});
