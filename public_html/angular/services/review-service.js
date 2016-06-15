app.constant("REVIEW_ENDPOINT", "php/apis/review/");
app.service("ReviewService", function($http, REVIEW_ENDPOINT) {

	function getUrl() {
		return(REVIEW_ENDPOINT);
	}

	function getUrlForReviewId(reviewId) {
		return(getUrl() + reviewId);
	}

	this.fetchReviewByReviewId = function(reviewId) {
		return($http.get(getUrlForId(reviewId)));
	};

	this.fetchReviewByReviewBeerId = function(reviewBeerId) {
		return($http.get(getUrl()+ "?reviewBeerId=" + reviewBeerId));
	};

	this.fetchReviewByReviewUserId = function(reviewUserId) {
		return($http.get(getUrl()+ "?reviewUserId=" + reviewUserId));
	};
	this.fetchReviewByReviewDate = function(reviewDate) {
		return($http.get(getUrl()+ "?reviewDate=" + reviewDate));
	};
	this.fetchReviewByReviewPintRating = function(reviewPintRating) {
		return($http.get(getUrl()+ "?reviewPintRating=" + reviewPintRating));
	};


	this.fetchAllReviews = function() {
		return($http.get(getUrl()));
	};

	this.update = function(reviewId, review) {
		return($http.put(getUrlForReviewId(reviewId, review)));
	};

	this.create = function(review) {
		return($http.post(getUrl(), review));
	};

	this.destroy = function(reviewId) {
		return($http.delete(getUrlForReviewId(reviewId)));
	}
});
