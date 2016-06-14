app.controller('SigninController', ["$scope", "SigninService", "$location", function($scope, SigninService, $location) {
	$scope.alerts = [];
	$scope.login = [];

	$scope.login = function(signInData) {
		console.log(signInData);
		SigninService.signin(signInData)
			
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.signInData = result.data.data;

				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};

				}
			})
	}
}]);

/**
 *Possible code
 **/
//
//
//
// 		Auth.signIn($scope.credentials).then(function () {
// 			// user successfully authenticated, refresh UserProfile
// 			return userProfile.$refresh();
// 		}).then(function () {
// 			// UserProfile is refreshed, redirect user somewhere
// 			$state.go("home");
// 		});
// 	};
//
// }])
