app.service("SignoutService", function($http) {
	this.SIGNOUT_ENDPOINT = "../../angular/controllers/signout-controller.php";

	this.signout = function() {
		return ($http.get(this.SIGNOUT_ENDPOINT));
	}
});