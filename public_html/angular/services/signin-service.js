
//"signinService refers to what's in the signin-controller.
app.constant("SIGNIN_ENDPOINT", "php/apis/signin/");
app.service("SigninService", function($http, SIGNIN_ENDPOINT) {
	function getUrl() {
		return(SIGNIN_ENDPOINT);
	}
	this.signin = function(signInData) {
		return($http.post(getUrl(), signInData));
	};
});
