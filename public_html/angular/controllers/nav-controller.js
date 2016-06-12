app.controller("navController", ["$scope", function($scope) {
	$scope.breakpoint = null;
	$scope.navCollapsed = null;

	// collapse the navbar if the screen is changed to a extra small screen
	$scope.$watch("breakpoint", function() {
		$scope.navCollapsed = ($scope.breakpoint === "xs");
	});
}]);
