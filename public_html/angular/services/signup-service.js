app.constant("SIGNUP_ENDPOINT", "php/api/signup/");
app.service("SignupService", function($http, SIGNUP_ENDPOINT) {
	function getUrl() {
		return(SIGNUP_ENDPOINT);
	}
	this.create = function(signup) {
		return($http.post(getUrl(), signup));
	};
});
