app.controller('ReviewController', ["$scope", "userService", function($scope, userService) {
	$scope.alerts = [];
	$scope.userData = [];

	$scope.getUserById = function() {
		userService.fetchUserById(userId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})