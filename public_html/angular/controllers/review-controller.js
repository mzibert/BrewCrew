app.controller('ReviewController', ["$scope", "ReviewService", function($scope, ReviewService) {
	$scope.alerts = [];
	$scope.userData = [];

	$scope.getReviewById = function() {
		ReviewService.fetchReviewByReviewId(reviewId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};
	$scope.getReviewBeerId = function() {
		ReviewService.fetchReviewBeerId(reviewBeerId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getReviewUserId = function() {
		ReviewService.fetchReviewUserId(reviewBeerId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};
	$scope.getReviewUserId = function() {
		ReviewService.fetchReviewUserId(reviewUserId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};
	$scope.getReviewDate = function() {
		ReviewService.fetchReviewDate(reviewDate)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};
	$scope.getReviewPintRating = function() {
		ReviewService.fetchReviewPintRatingl(reviewPintRating)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};
	]