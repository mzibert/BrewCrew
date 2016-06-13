app.controller("SigninController", ["$scope","SigninService",  function($scope,
	SigninService) {
	$scope.signinData = [];
	$scope.alerts = [];

	$scope.getUserById = function() {
		UserService.fetchUserById(userId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};
}]);