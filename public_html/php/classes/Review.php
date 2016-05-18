<?php
namespace Edu\Cnm\BrewCrew;

require_once("autoload.php");

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

	/**
	 * constructor for review
	 *
	 * @param int|null $newReviewId of this review or null if this is a new review
	 * @param int $newReviewBeerId for the beer that is being reviewed
	 * @param int $newReviewUserId for the user that created the review
	 * @param \DateTime|null $newReviewDate the associated timestamp for a review, or null if being set to current date and time
	 * @param int $newReviewPintRating the pint rating assigned to a review
	 * @param string $newReviewText string that contains the text of the review
	 * @throws \InvalidArgumentException if the data types are not valid
	 * @throws \RangeException if the data values are out of bounds (e.g., strings are too long, integers are negative or out of range, etc)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function __construct(int $newReviewId = null, int $newReviewBeerId, int $newReviewUserId, $newReviewDate = null, int $newReviewPintRating, string $newReviewText) {
		try {
			$this->setReviewId($newReviewId);
			$this->setReviewBeerId($newReviewBeerId);
			$this->setReviewUserId($newReviewUserId);
			$this->setReviewDate($newReviewDate);
			$this->setReviewPintRating($newReviewPintRating);
			$this->setReviewText($newReviewText);
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



	//BEGIN ACCESSORS AND MUTATORS FOR REVIEW
	/**
	 * accessor method for review id
	 *
	 * @return int|null value of review id, will be null if this is a new review
	 **/
	public function getReviewId() {
		return ($this->reviewId);
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

		//convert and store the review id
		$this->reviewId = $newReviewId;
	}


	/**
	 * accessor method for review beer id
	 *
	 * @return int value of review beer id, a foreign key
	 */
	public function getReviewBeerId() {
		return ($this->reviewBeerId);
	}

	/**
	 * mutator method of beer id
	 * @param int $newReviewBeerId creates new value for beer id
	 * @throws \RangeException if $newReviewBeerId is not positive
	 * @throws \TypeError is $newReviewBeerId is not an integer
	 */
	public function setReviewBeerId(int $newReviewBeerId) {
		//verify that the review beer id is positive
		if($newReviewBeerId <= 0) {
			throw(new \RangeException("Beer Id is not positive"));
		}
		//convert and store the review beer id
		$this->reviewBeerId = $newReviewBeerId;
	}

	/**
	 * accessor method for review user id
	 *
	 * @return int value of review user id, a foreign key
	 */
	public function getReviewUserId() {
		return ($this->reviewUserId);
	}

	/**
	 * mutator method for review user id
	 * @param int $newReviewUserId creates a new value for user id
	 * @throws \RangeException if $newReviewUserId is not positive
	 * @throws \TypeError if $newReviewUserId is not an integer
	 */

	public function setReviewUserId(int $newReviewUserId) {
		//verify that the review user id is a positive integer
		if($newReviewUserId <= 0) {
			throw(new \RangeException("User id is not positive"));
		}

		//convert and store the review user id
		$this->reviewUserId = $newReviewUserId;
	}


	/**
	 * accessor method for review date
	 *
	 * @return \DateTime value for the review
	 */

	public function getReviewDate() {
		return ($this->reviewDate);
	}

	/**
	 * mutator method for review date
	 *
	 * @param \DateTime|string|null $newReviewDate the date of the review as a DateTime object, or null to load the current time
	 * @throws \InvalidArgumentException if $newReviewDate is not a valid object
	 * @throws \RangeException if $newReviewDate is a date that does not exist
	 */
	public function setReviewDate($newReviewDate = null) {
		//base case-- if the date is null, use the current date and time
		if($newReviewDate === null) {
			$this->reviewDate = new \DateTime();
			return;
		}

		//store the review date
		try {
			$newReviewDate = $this->validateDate($newReviewDate);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}
		$this->reviewDate = $newReviewDate;
	}

	/**
	 * accessor method for pint rating
	 *
	 * @return int value of the pint rating
	 */
	public function getReviewPintRating() {
		return ($this->reviewDate);
	}

	/**
	 * mutator method for pint rating
	 *
	 * @param int $newReviewPintRating sets new value for the pint rating
	 * @throws \RangeException if pint rating is not 1-5
	 * @throws \TypeError if the pint rating is not an integer
	 */
	public function setReviewPintRating(int $newReviewPintRating) {
		//check that the pint rating is 1-5
		//or is either 'or' or '||'. || has higher precedence
		if($newReviewPintRating < 1 || $newReviewPintRating > 5) {
			throw(new \RangeException("Pint Rating must be between 1 and 5"));
		}

		//Store the pint rating
		$this->reviewPintRating = $newReviewPintRating;
	}

	/**accessor method for review text
	 *
	 * @return string value for review text
	 */
	public function getReviewText() {
		return ($this->reviewText);
	}

	/**
	 * mutator method for review text
	 *
	 * @param string $newReviewText new value for the review text
	 * @throws \InvalidArgumentException if $newReviewText is not a string or contains insecure content
	 * @throws \RangeException if $newReviewText is greater than 2000 characters
	 * @throws \TypeError if $newReviewText is not a string
	 */
	public function setReviewText(string $newReviewText = null) {
		//if user isn't leaving a text review, don't even bother
		if($newReviewText === null) {
			return;
		}

		//verify that the review text is valid and/or secure
		$newReviewText = trim($newReviewText);
		$newReviewText = filter_var($newReviewText, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newReviewText) === true) {
			throw(new \InvalidArgumentException("Review is empty or is insecure"));
		}

		//verify that the text of the review will fit in the database
		if(strlen($newReviewText) > 2000) {
			throw(new \RangeException("Text of review is too long. Limited to 2000 characters."));
		}

		//store the text of the review
		$this->reviewText = $newReviewText;
	}

	//BEGIN PDOs FOR REVIEW
	/**
	 * inserts the review into the mySQL database
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related error occurs
	 * @throws \TypeError when $pdo is not a PDO connection object
	 */
	public function insert(\PDO $pdo) {
		//enforce that the review id is null (aka don't insert a review that already exists)
		if($this->reviewId !== null) {
			throw(new \PDOException("Review is not new"));
		}

		//create a query template
		$query = "INSERT INTO review(reviewBeerId, reviewUserId, reviewDate, reviewPintRating, reviewText) VALUES (:reviewBeerId, :reviewUserId, :reviewDate, :reviewPintRating, :reviewText)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$formattedDate = $this->reviewDate->format("Y-m-d H:i:s");
		$parameters = ["reviewBeerId" => $this->reviewBeerId, "reviewUserId" => $this->reviewUserId, "reviewDate" => $formattedDate, "reviewPintRating" => $this->reviewPintRating, "reviewText" => $this->reviewText];
		$statement->execute($parameters);

		//update the null reviewId with what mySQL just gave us
		$this->reviewId = intval($pdo->lastInsertId());
	}

	/**
	 * delete this review from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related error occurs
	 * @throws \TypeError when $pdo is not a PDO connection object
	 */
	public function delete(\PDO $pdo) {
		//enforce that that reviewId is not null (aka doesn't exist, so cannot delete)
		if($this->reviewId === null) {
			throw(new \PDOException("Cannot delete a review that doesn't exist"));
		}

		//create a query template
		$query = "DELETE FROM review WHERE reviewId = :reviewId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["reviewId" => $this->reviewId];
		$statement->execute($parameters);
	}

	/**
	 * updates the review in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related error occurs
	 * @throws \TypeError when $pdo is not a PDO connection object
	 */
	public function update(\PDO $pdo) {
		//enforce that the review id is not null (aka don't update a review that doesn't exist)
		if($this->reviewId === null) {
			throw(new \PDOException("Review is not new"));
		}

		//create a query template
		$query = "UPDATE review SET reviewBeerId = :reviewBeerId, reviewUserId = :reviewUserId, reviewDate = :reviewDate, reviewPintRating = :reviewPintRating, reviewText = :reviewTextRating WHERE reviewId = :reviewId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$formattedDate = $this->reviewDate->format("Y-m-d H:i:s");
		$parameters = ["reviewBeerId" => $this->reviewBeerId, "reviewUserId" => $this->reviewUserId, "reviewDate" => $formattedDate, "reviewPintRating" => $this->reviewPintRating, "reviewText" => $this->reviewText];
		$statement->execute($parameters);
	}

	/**
	 * get the review by reviewId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $reviewId the reviewId to search for
	 * @return Review|null either the review, or null if not found
	 * @throws \PDOException when mySQL related errors are found
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getReviewByReviewId(\PDO $pdo, int $reviewId) {
		//sanitize the reviewId before searching
		if($reviewId <= 0) {
			throw(new \PDOException ("Review id is not positive"));
		}

		//create query template
		$query = "SELECT reviewId, reviewBeerId, reviewUserId, reviewDate, reviewPintRating, reviewText FROM review WHERE reviewId = :reviewId";
		$statement = $pdo->prepare($query);

		//bind the review id to the place holder in the template
		$parameters = array("reviewId" => $reviewId);
		$statement->execute($parameters);

		//grab the review from mySQL
		try {
			$review = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$review = new Review($row["reviewId"], $row["reviewBeerId"], $row["reviewUserId"], $row["reviewDate"], $row["reviewPintRating"], $row["reviewText"]);
			}
		} catch(\Exception $exception) {
			//if the row couldn't be converted rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($review);
	}


	/** get the review by beerId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $reviewBeerId the reviewBeerId to search for
	 * @return \SplFixedArray SplFixedArray of reviews or null if not found
	 * @throws \PDOException when mySQL related errors are found
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getReviewByBeerId(\PDO $pdo, int $reviewBeerId) {
		//sanitize the beerId before searching
		if($reviewBeerId <= 0) {
			throw(new \PDOException ("beer id is not positive"));
		}

		//create query template
		$query = "SELECT reviewId, reviewBeerId, reviewUserId, reviewDate, reviewPintRating, reviewText FROM review WHERE reviewBeerId = :reviewBeerId";
		$statement = $pdo->prepare($query);

		//bind the beer id to the place holder in the template
		$parameters = array("reviewBeerId" => $reviewBeerId);
		$statement->execute($parameters);

		//build an array of reviews
		$reviews = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$review = new Review($row["reviewId"], $row["reviewBeerId"], $row["reviewUserId"], $row["reviewDate"], $row["reviewPintRating"], $row["reviewText"]);
				$reviews[$reviews->key()] = $review;
				$reviews->next();
			} catch(\Exception $exception) {
				//if the row couldn't be converted rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($reviews);
	}


	/** get the review by userId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $reviewUserId the reviewUserId to search for
	 * @return \SplFixedArray SplFixedArray of reviews or null if not found
	 * @throws \PDOException when mySQL related errors are found
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getReviewByUserId(\PDO $pdo, int $reviewUserId) {
		//sanitize the beerId before searching
		if($reviewUserId <= 0) {
			throw(new \PDOException ("beer id is not positive"));
		}

		//create query template
		$query = "SELECT reviewId, reviewBeerId, reviewUserId, reviewDate, reviewPintRating, reviewText FROM review WHERE reviewUserId = :reviewUserId";
		$statement = $pdo->prepare($query);

		//bind the user id to the place holder in the template
		$parameters = array("reviewUserId" => $reviewUserId);
		$statement->execute($parameters);

		//build an array of reviews
		$reviews = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$review = new Review($row["reviewId"], $row["reviewBeerId"], $row["reviewUserId"], $row["reviewDate"], $row["reviewPintRating"], $row["reviewText"]);
				$reviews[$reviews->key()] = $review;
				$reviews->next();
			} catch(\Exception $exception) {
				//if the row couldn't be converted rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($reviews);
	}


	/** get the review by breweryId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $breweryId the breweryId to search for
	 * @return \SplFixedArray SplFixedArray of reviews or null if not found
	 * @throws \PDOException when mySQL related errors are found
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getReviewByBreweryId(\PDO $pdo, int $breweryId) {
		//sanitize the breweryId before searching
		if($breweryId <= 0) {
			throw(new \PDOException ("brewery id is not positive"));
		}

		//create query template
		$query = "SELECT reviewId, reviewBeerId, reviewUserId, reviewDate, reviewPintRating, reviewText, breweryId FROM review
INNER JOIN beer ON review.reviewBeerId = beer.beerId 
INNER JOIN brewery ON beer.beerBreweryId = brewery.breweryId
WHERE breweryId = :breweryId";
		$statement = $pdo->prepare($query);

		//bind the brewery id to the place holder in the template
		$parameters = array("breweryId" => $breweryId);
		$statement->execute($parameters);

		//build an array of reviews
			$reviews = new \SplFixedArray($statement->rowCount());
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			while(($row = $statement->fetch()) !== false) {
				try {
					$review = new Review($row["reviewId"], $row["reviewBeerId"], $row["reviewUserId"], $row["reviewDate"], $row["reviewPintRating"], $row["reviewText"]);
					$reviews[$reviews->key()] = $review;
					$reviews->next();
				} catch(\Exception $exception) {
					//if the row couldn't be converted rethrow it
					throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($reviews);
	}

	/**
	 * get review by pint rating
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $reviewPintRating pint rating to search for
	 * @return \SplFixedArray SplFixedArray of reviews that are found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public function getReviewByReviewPintRating(\PDO $pdo, int $reviewPintRating) {
		//check that the pint rating is 1-5
		if($reviewPintRating < 1 || $reviewPintRating > 5) {
			throw(new \RangeException("Pint Rating must be between 1 and 5"));
		}

		//create query template
		$query = "SELECT reviewId, reviewBeerId, reviewUserId, reviewDate, reviewPintRating, reviewText FROM review WHERE reviewPintRating LIKE :reviewPintRating";
		$statement = $pdo->prepare($query);

		//bind the review content to the place holder in the template
		$reviewContent = "%reviewContent%";
		$parameters = array("reviewContent" => $reviewContent);
		$statement->execute($parameters);

		//build an array of reviews
		$reviews = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$review = new Review($row["reviewId"], $row["reviewBeerId"], $row["reviewUserId"], $row["reviewDate"], $row["reviewPintRating"], $row["reviewText"]);
				$reviews[$reviews->key()] = $review;
				$reviews->next();
			} catch(\Exception $exception) {
				//if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($reviews);
	}
	

//jsonSerialize
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["reviewDate"] = intval($this->reviewDate->format("U")) * 1000;
		return ($fields);
	}

}