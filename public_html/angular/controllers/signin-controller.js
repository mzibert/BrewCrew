app.controller('SigninController', ["$scope", '$location',"$window","SigninService", function($scope,$location, $window, SigninService) {
	$scope.alerts = [];

	$scope.signin = function(signInData, validated) {
		console.log("inside signincontroller signin");
		console.log(signInData);
		if(validated === true) {
			SigninService.signin(signInData)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
						console.log("good status");
						$location.path( "/home" );


					} else {
						console.log("bad status");
						console.log(result.data);
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};
}]);