app.controller("signupController", ["$scope", "SignupService", "$location", function($scope, SignupService, $location) {
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
			SignupService.create(signUpData)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
						$location.url("signup/home.php");
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};
}]);