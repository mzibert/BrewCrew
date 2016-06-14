app.service('LogoutService', function($http){
	this.LOGOUT_ENDPOINT = 'php/apis/logout/';

	this.logout = function() {
		return($http.get(this.LOGOUT_ENDPOINT));
	};
});
