
app.constant("SIGNIN_ENDPOINT", "php/apis/signin/");
app.service("SigninService", function($http, SIGNIN_ENDPOINT) {
	function getUrl() {
		return(SIGNIN_ENDPOINT);
	}
	this.signin = function(signin) {
		return($http.post(getUrl(), signin));
	};
});