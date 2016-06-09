app.controller("SignupController", ["$scope", "SignupService", "$location", function($scope, SignupService, $location) {
	$scope.alerts = [];
	$scope.activationData = {};

	/**
	 * Method that uses the activation service to activate an account
	 *
	 * @param signUpData will contain activation token and password
	 * @param validated true if form is valid, false if not
	 */

	$scope.sendActivation = function(signUpData, validated) {
		if(validated === true) {
			console.log("line 14 controller");
			SignupService.create(signUpData)
				.then(function(result) {
					if(result.data.status === 200) {
						console.log("line 17 controller");
						$scope.alerts[0] = {type: "success", msg: result.data.message};
						$location.url("userSignUpForm");
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};
}]);