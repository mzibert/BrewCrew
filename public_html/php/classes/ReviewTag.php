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

	//CONSTRUCTOR
	/**
	 * constructor for reviewTag
	 *
	 * @param int $newReviewTagReviewId foreign key review id
	 * @param int $newReviewTagTagId foreign key tag id
	 * @throws \InvalidArgumentException if the data types are not valid
	 * @throws \RangeException if the data values are out of bound (e.g. negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function __construct(int $newReviewTagReviewId, int $newReviewTagTagId) {
		try {
			$this->setReviewTagReviewId($newReviewTagReviewId);
			$this->setReviewTagTagId($newReviewTagTagId);
		} catch(\InvalidArgumentException $invalidArgument) {
			//rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			//rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			//rethrow the exception to the caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			//rethrow the exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

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
		return ($this->reviewTagTagId);
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

	/**
	 * inserts the reviewTag into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function insert(\PDO $pdo) {
		//check that that reviewTag exists before inserting
		if($this->reviewTagReviewId === null || $this->reviewTagTagId === null) {
			throw(new \PDOException("Review or Tag are not valid, not a valid reviewTag"));
		}
		//create a query template
		$query = "INSERT INTO reviewTag(reviewTagReviewId, reviewTagTagId) VALUES(:reviewTagReviewId, :reviewTagTagId)";
		$statement = $pdo->prepare($query);

		//bind the variables to the place holders in the template
		$parameters = ["reviewTagReviewId" => $this->reviewTagReviewId, "reviewTagTagId" => $this->reviewTagTagId];
		$statement->execute($parameters);
	}

	/**
	 * deletes the reviewTag from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function delete(\PDO $pdo) {
		//check that object exists before deleting
		if($this->reviewTagReviewId === null || $this->reviewTagTagId === null) {
			throw(new \PDOException("Review or Tag are not valid, not a valid reviewTag"));
		}
		//create a query template
		$query = "DELETE FROM reviewTag WHERE reviewTagReviewId = :reviewTagReviewId AND reviewTagTagId = :reviewTagTagId";
		$statement = $pdo->prepare($query);

		//bind the variables to the place holders in the template
		$parameters = ["reviewTagReviewId" => $this->reviewTagReviewId, "reviewTagTagId" => $this->reviewTagTagId];
		$statement->execute($parameters);
	}

	/**
	 * get the reviewTag by review Id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $reviewTagReviewId review id to search for
	 * @return \SplFixedArray of ReviewTags found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data types
	 */
	public static function getReviewTagByReviewId(\PDO $pdo, int $reviewTagReviewId) {
		//sanitize the review id
		if($reviewTagReviewId < 0) {
			throw(new \PDOException("Review Id is not positive"));
		}
		//create query template
		$query = "SELECT reviewTagReviewId, reviewTagTagId FROM reviewTag WHERE reviewTagReviewId = :reviewTagReviewId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["reviewTagReviewId" => $reviewTagReviewId];
		$statement->execute($parameters);

		//build an array of reviewTags
		$reviewTags = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$reviewTag = new ReviewTag($row["reviewTagReviewId"], $row["reviewTagTagId"]);
				$reviewTags[$reviewTags->key()] = $reviewTag;
				$reviewTags->next();
			} catch(\Exception $exception) {
				//if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($reviewTags);
	}


	/**
	 * get the reviewTag by tag Id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $reviewTagTagId tag id to search for
	 * @return \SplFixedArray of ReviewTags found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data types
	 */
	public static function getReviewTagByTagId(\PDO $pdo, int $reviewTagTagId) {
		//sanitize the review id
		if($reviewTagTagId < 0) {
			throw(new \PDOException("Tag Id is not positive"));
		}
		//create query template
		$query = "SELECT reviewTagReviewId, reviewTagTagId FROM reviewTag WHERE reviewTagTagId = :reviewTagTagId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["reviewTagTagId" => $reviewTagTagId];
		$statement->execute($parameters);

		//build an array of reviewTags
		$reviewTags = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$reviewTag = new ReviewTag($row["reviewTagReviewId"], $row["reviewTagTagId"]);
				$reviewTags[$reviewTags->key()] = $reviewTag;
				$reviewTags->next();
			} catch(\Exception $exception) {
				//if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($reviewTags);
	}

//get review tag by review id and tag id
	/**
	 * gets the reviewTag by both review id and tag id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $reviewTagReviewId review id to search for
	 * @param int $reviewTagTagId tag id to search for
	 * @return ReviewTag|null reviewTag if found or null if not
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not of the correct data type
	 */
	public static function getReviewTagByReviewIdAndTagId(\PDO $pdo, int $reviewTagReviewId, int $reviewTagTagId) {
		//sanitize the review id and tag id before searching
		if($reviewTagReviewId < 0) {
			throw(new \PDOException("review id is not positive"));
		}
		if($reviewTagTagId < 0) {
			throw(new \PDOException("tag is is not positive"));
		}

		//create a query template
		$query = "SELECT reviewTagReviewId, reviewTagTagId FROM reviewTag WHERE reviewTagReviewId = :reviewTagReviewId AND reviewTagTagId = :reviewTagTagId";
		$statement = $pdo->prepare($query);

		//bind the variables to the place holders in the template
		$parameters = ["reviewTagReviewId" => $reviewTagReviewId, "reviewTagTagId" => $reviewTagTagId];
		$statement->execute($parameters);

		//grab the reviewTag from mySQL
		try {
			$reviewTag = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$reviewTag = new ReviewTag($row["reviewTagReviewId"], $row["reviewTagTagId"]);
			}
		} catch(\Exception $exception) {
			//if the row couldn't be converted rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($reviewTag);
	}
	


	//jsonSerialize
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return ($fields);
	}
}