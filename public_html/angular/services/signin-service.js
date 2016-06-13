app.constant("SIGNIN_ENDPOINT", "php/api/signin/");
app.service("SigninService", function(SIGNIN_ENDPOINT) {
	function getUrl() {
		return(SIGNIN_ENDPOINT_ENDPOINT);
	}
	this.login = function(signin) {
		return($http.post(getUrl(), signin));
	};
});
