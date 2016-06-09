app.directive("bootstrapBreakpoint", ["$window", function($window) {
	// define standard Bootstrap breakpoints
	var breakpoints = {
		xs: "<div id=\"bootstrap-breakpoint-xs\" class=\"device-xs visible-xs visible-xs-block\"></div>",
		sm: "<div id=\"bootstrap-breakpoint-sm\" class=\"device-sm visible-sm visible-sm-block\"></div>",
		md: "<div id=\"bootstrap-breakpoint-md\" class=\"device-md visible-md visible-md-block\"></div>",
		lg: "<div id=\"bootstrap-breakpoint-lg\" class=\"device-lg visible-lg visible-lg-block\"></div>"
	};
	return({
		// detect breakpoints based on visibility
		link: function postLink(scope) {
			scope.detectBreakpoint = function() {
				for(var breakpoint in breakpoints) {
					var detectionDiv = angular.element(document.querySelector("#bootstrap-breakpoint-" + breakpoint))[0];
					if(detectionDiv.offsetHeight > 0 || detectionDiv.offsetWidth > 0) {
						scope.breakpoint = breakpoint;
						break;
					}
				}
			};

			// detect the breakpoint on load
			scope.detectBreakpoint();

			// reload breakpoints on resize
			angular.element($window).bind("resize", function() {
				scope.detectBreakpoint();
				scope.$apply();
			});
		},
		restrict: "E",
		template: breakpoints.xs + breakpoints.sm + breakpoints.md + breakpoints.lg
	});
}]);
