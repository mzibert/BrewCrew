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
		ReviewService.fetchReviewPintRating(reviewPintRating)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};
	$scope.getAllReviews = function() {
		ReviewService.fetchAllReviews()
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.data = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};
	/**
	 * creates a review and sends it to the review API
	 *
	 * @param review
	 * @param validated true if Angular validated the form, false if not
	 **/
	$scope.createReview = function(review, validated) {
		if(validated === true) {
			ReviewService.create(review)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
						$scope.newReview = {reviewId: null, reviewBeerId: null, reviewUserId: null, reviewDate: "", reviewPintRating: null, reviewText: ""};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};

	/**
	 * updates a review and sends it to the review API
	 *
	 * @param review
	 * @param validated true if Angular validated the form, false if not
	 **/
	$scope.updateReview= function(review, validated) {
		if(validated === true) {
			ReviewService.update(review.reviewId, review)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};

}]);
