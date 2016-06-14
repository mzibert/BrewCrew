
//"signinService refers to what's in the signin-controller.
app.constant("SIGNIN_ENDPOINT", "php/apis/signin/");
app.service("SigninService", function($http){
	this.SIGNIN_ENDPOINT = "../../angular/controllers/signin-controller.php";

	this.signin = function(signinData) { //signinData from the signin-controller
		return($http.post(this.SIGNIN_ENDPOINT, signinData)
			.then(function(reply) {
				return(reply.data);
			}));
	};
});
