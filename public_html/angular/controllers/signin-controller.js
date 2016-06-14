app.controller("SigninController", ["$scope","SigninService",  function($scope,
	SigninService) {
	$scope.signinData = [];
	$scope.alerts = [];

	$scope.getUserById = function(userId) {
		SigninService.fetchUserById(userId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};
	$scope.getUserByUserName = function(userName) {
		SigninService.fetchUserByUserName(userName)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};
	$scope.getUserByUserPassword = function(userPassword) {
		SigninService.fetchUserByUserPassword(userPassword)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};
}]);