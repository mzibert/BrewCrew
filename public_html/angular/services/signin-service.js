
app.constant("SIGNIN_ENDPOINT", "php/api/signin/");
app.service("SigninService", function($http, signin_ENDPOINT) {
	function getUrl() {
		return(signin_ENDPOINT);
	}
	this.signin = function(signin) {
		return($http.post(getUrl(), signin));
	};
});