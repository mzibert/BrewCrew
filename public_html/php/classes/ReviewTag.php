<?php
namespace Edu\Cnm\BrewCrew;

require_once("autoload.php");

/**
 * ReviewTag Class
 *
 * This class consists of everything required to give users the ability to link beers with associated flavor tags.
 *
 * @author Alicia Broadhurst <abroadhurst@cnm.edu>
 *
 */
class ReviewTag implements \JsonSerializable {
	use ValidateDate;
	/**
	 * review id for the review being linked with tags, a foreign key
	 * @var int $reviewTagReviewId
	 */
	private $reviewTagReviewId;
	/**
	 * tag id for the tag being linked to the review, a foreign key
	 * @var int $reviewTagReviewId
	 */
	private $reviewTagTagId;
	
	//TODO CONSTRUCTOR
	//TODO CONSTRUCTOR
	
	//ACCESSORS AND MUTATORS
	
	/**
	 * accessor method for reviewTag reviewId
	 * 
	 * @return int value of reviewTag review id, a foreign key
	 */
	public function getReviewTagReviewId() {
		return ($this->reviewTagReviewId);
	}
	/**
	 * mutator method for reviewTag tagId
	 * 
	 * @param int $newReviewTagReviewId
	 * @throws \RangeException if $newReviewTagReviewId id is not postitive
	 * @throws \TypeError if $newReviewTagReviewId is not an integer
	 */
	public function setReviewTagReviewId(int $newReviewTagReviewId) {
		//verify that the id is positive
		if($newReviewTagReviewId < 0) {
			throw(new \RangeException("review id is not positive"));
		}
		//convert and store the review id
		$this->reviewTagReviewId = $newReviewTagReviewId;
	}
	/**
	 * accessor method for reviewTag TagId
	 *
	 * @return int value of reviewTag tag id, a foreign key
	 */
	public function getReviewTagTagId() {
		return($this->reviewTagTagId);
	}

	/**
	 * mutator method for reviewTag Tag Id
	 *
	 * @param int $newReviewTagTagId
	 * @throws \RangeException if $newReviewTagTagId is not positive
	 * @throws \TypeError if $newReviewTagTagId is not an integer
	 */
	public function setReviewTagTagId(int $newReviewTagTagId) {
		//verify that the id is positive
		if($newReviewTagTagId < 0) {
			throw(new \RangeException("tag id is not positive"));
		}
		//convert and store the tag id
		$this->reviewTagTagId = $newReviewTagTagId;
	}

	//BEGIN PDOs for REVIEWTAG



}