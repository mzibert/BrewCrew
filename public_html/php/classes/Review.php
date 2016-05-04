<?php
namespace Edu\Cnm\BrewCrew;

require_once("autoload . php");

/**
 * Review Class
 *
 * This class consists of everything required to create and manage a review system for the Beer Compass webapp. This will allow users to choose a rating from a 5-point scale, and create an optional text review for any given beer in the system.  Once tied with the ReviewTag class, users will be able to link beers with associated flavor tags.
 *
 * @author Alicia Broadhurst <abroadhurst@cnm.edu>
 *
 */

class Review implements \JsonSerializable {
	use ValidateDate;
	/**
	 * review id; the primary key
	 * @var int $reviewId
	 *
	 */
	private $reviewId;
	/**
	 * reviewBeerId (aka beerId); a foreign key
	 * @var int $reviewBeerId
	 **/
	private $reviewBeerId;
	/**
	 * reviewUserId (aka userId); a foreign key
	 * @var int $reviewUserId
	 **/
	private $reviewUserId;
	/**
	 * reviewDate, the associated timestamp for a review
	 * @var \DateTime $reviewDate
	 **/
	private $reviewDate;
	/**
	 * reviewPintRating, the assigned rating for a beer on a 5-point scale
	 * @var int $reviewPintRating
	 **/
	private $reviewPintRating;
	/**
	 * reviewText, text content for the review
	 * @var string $reviewText
	 **/
	private $reviewText;
	
	//CONSTRUCT goes here
	//CONSTRUCT
	//CONSTRUCT

	
	/**
	 * accessor method for review id
	 *
	 * @return int|null value of review id, will be null if this is a new review
	 **/
	public function getReviewId() {
		return($this->reviewId);
	}

	/**
	 * mutator method for review id
	 *
	 * @param int|null $newReviewId creates new value for review id
	 * @throws \RangeException if $newReviewId is not positive
	 * @throws \TypeError if $newReviewId is not an integer
	 **/
	public function setReviewId(int $newReviewId = null) {
		//when this is null, this is a new review with no mySQL id yet
		if($newReviewId === null) {
			$this->reviewId = null;
			return;
		}

		//verify that the review id is positive
		if($newReviewId <= 0) {
			throw(new \RangeException("Review Id is not positive"));
		}

		//store the review id
		$this->reviewId = $newReviewId;
	}

	/**
	 * accessor method for
	 */

}


