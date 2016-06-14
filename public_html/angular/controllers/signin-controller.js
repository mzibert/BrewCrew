app.controller('SigninController', ["$scope", "$window","SigninService", function($scope, $window, SigninService) {
	$scope.alerts = [];

	$scope.signin = function(formData, validated) {
		console.log("inside signincontroller signin");
		console.log(formData);
		if(validated === true) {
			SigninService.signin(formData)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
						console.log("good status");
						$window.location.href = "search/"
					} else {
						console.log("bad status");
						console.log(result.data);
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};
}]);