app.controller('UserController', ["$scope", "userService", function($scope, userService) {
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
	};

	$scope.getUserByActivation = function() {
		userService.fetchUserByActivation(userActivation)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};


	$scope.getUserByUserDateOfBirth = function(){
		userService.fetchUserByUserDateOfBirth(userDateOfBirth)
			.then(function(result){
				if(result.status.data === 200){
					$scope.data = result.data.data;
				}else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};
	$scope.getUserByUserEmail = function() {
		userService.fecthUserByUserEmail(userEmail)
			.then(function(result) {
				if(rsult.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};


]