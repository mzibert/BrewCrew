app.controller('UserController', ["$scope", "UserService", function($scope, UserService) {
	$scope.alerts = [];
	$scope.userData = [];

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
	$scope.getUserByUserFirstName = function() {
		userService.fetchUserByUserFirstName(userFirstName)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getUserByUserLastName = function() {
		userService.fetchUserByUserLastName(userLastName)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getUserByUserUsername = function() {
		userService.fetchUUserByUserUsername(userUsername)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getAllUsers = function() {
		userService.fetchAllUsers()
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	/**
	 * creates a user and sends it to the user API
	 *
	 * @param user the user to send
	 * @param validated true if Angular validated the form, false if not
	 **/
	$scope.createUser = function(user, validated) {
		if(validated === true) {
			userService.create(user)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
						$scope.newUser = {userId: null, userActivationToken: null,userDateOfBirth: "", userEmail: "", userFirstName: "", userLastName: ""};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};

	/**
	 * updates a user and sends it to the user API
	 *
	 * @param user the user to send
	 * @param validated true if Angular validated the form, false if not
	 **/
	$scope.updateUser= function(user, validated) {
		if(validated === true) {
			userService.update(user.userId, user)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};
	// load the array on first view
	if($scope.user === null) {
		$scope.getUser();
	}


}]);


