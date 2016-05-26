<?php
namespace Edu\Cnm\BrewCrew;

require_once("autoload.php");

/**
 * Class BeerTag
 * 
 * This class contains everything for a user to be able to link beer flavor tags with the beers that they drink
 * 
 * @author Merri Zibert <mzibert@cnm.edu>
 **/
class BeerTag implements \JsonSerializable {
	/**
	 * this is the Id for this beer that this beer tag refers to, this is the foreign key
	 * @var int $beerTagBeerId
	 **/
	private $beerTagBeerId;
	/**
	 * this is the Id for this tag that was applied to this specific beer tag, this is a foreign key
	 * @var int $beerTagTagId
	 **/
	private $beerTagTagId;

	/**
	 * Constructor for class BeerTag
	 * @param int $newBeerTagBeerId new value of beer tag beer Id
	 * @param int $newBeerTagTagId new value of the tag id assigned to this beer
	 * @throws \InvalidArgumentException if the data types are not valid
	 * @throws \RangeException if data values are not positive
	 * @throws \TypeError if the data entered is the incorrect type
	 * @throws \Exception if any other type of errors occur
	 **/
	public function __construct(int $newBeerTagBeerId, int $newBeerTagTagId) {
		try {
			$this->setBeerTagBeerId($newBeerTagBeerId);
			$this->setBeerTagTagId($newBeerTagTagId);
		} catch(\InvalidArgumentException $InvalidArgument) {
			//rethrow the exception to the caller
			throw(new \InvalidArgumentException($InvalidArgument->getMessage(), 0, $InvalidArgument));
		} catch(\RangeException $range) {
			//rethrow the exception to the caller
			throw (new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			//rethrow exception to the caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\ Exception $exception) {
			//rethrow the exception to the caller
			throw (new \Exception($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessors and mutators for class beerTag
	 */
	/**
	 * accessor method for beerTagBeerId
	 * @return int value of beerTag beer Id, foreign key
	 **/
	public function getBeerTagBeerId() {
		return ($this->beerTagBeerId);
	}

	/**
	 * mutator method for beerTag beerId
	 * @param int $newBeerTagBeerId 
	 * @throws \RangeException if $newBeerTagBeerId is not positive
	 * @throws \TypeError if $newBeerTagBeerId is not an integer
	 **/
	public function setBeerTagBeerId(int $newBeerTagBeerId) {
		//verify the beer tag beer id content is positive
		if($newBeerTagBeerId <= 0) {
			throw (new \RangeException("beer tag beer id is not positive"));
		}
		// convert and store the new beer tag beer id
		$this->beerTagBeerId = $newBeerTagBeerId;
	}

	/**
	 * accessor method for beerTag TagId
	 * @return int value of beerTag tag Id, foreign key
	 **/
	public function getBeerTagTagId() {
		return ($this->beerTagTagId);
	}

	/**
	 * mutator method for beerTag tag Id
	 * @param int $newBeerTagTagId new value of the tag id assigned to this beer
	 * @throws \RangeException if $newBeerTagTagId is not positive
	 * @throws \TypeError if $newBeerTagTagId is not an integer
	 **/
	public function setBeerTagTagId(int $newBeerTagTagId) {
		//verify the beer tag tag Id content is positive
		if($newBeerTagTagId < 0) {
			throw (new \RangeException("beer tag tag Id is not positive"));
		}
		//convert and store the beer tag tag Id
		$this->beerTagTagId = $newBeerTagTagId;
	}

	/**
	 * inserts this beerTag into mySQL
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		//check that the beer tag exists before inserting into SQL
		if($this->beerTagBeerId === null || $this->beerTagTagId === null) {
			throw (new \PDOException("beer or tag not valid"));
		}
		//create query template
		$query = "INSERT INTO beerTag(beerTagBeerId, beerTagTagId) VALUES (:beerTagBeerId, :beerTagTagId)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["beerTagBeerId" => $this->beerTagBeerId, "beerTagTagId" => $this->beerTagTagId];
		$statement->execute($parameters);
	}

	/**
	 * deletes this beer tag from mySQL
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occure
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		// check that the object exists before deleting it
		if($this->beerTagBeerId === null || $this->beerTagTagId === null) {
			throw (new \PDOException ("beer or tag not valid"));
		}
		//create a query template
		$query = "DELETE FROM beerTag WHERE beerTagBeerId = :beerTagBeerId AND beerTagTagId = :beerTagTagId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holder in the template
		$parameters = ["beerTagBeerId" => $this->beerTagBeerId, "beerTagTagId" => $this->beerTagTagId];
		$statement->execute($parameters);
	}

	/**
	 * gets the beerTag by beer Id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $beerTagBeerId the beerId to search for
	 * @return \SplFixedArray of BeerTags found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getBeerTagByBeerId(\PDO $pdo, int $beerTagBeerId) {
		//sanitize the beer id
		if($beerTagBeerId < 0) {
			throw (new \PDOException("beer id is not positive"));
		}
		//create query template
		$query = "SELECT beerTagBeerId, beerTagTagId FROM beerTag WHERE beerTagBeerId = :beerTagBeerId";
		$statement = $pdo->prepare($query);

		//bind the beer id to the place holder in the template
		$parameters = ["beerTagBeerId" => $beerTagBeerId];
		$statement->execute($parameters);

		//build an array of beerTags
		$beerTags = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$beerTag = new BeerTag($row["beerTagBeerId"], $row["beerTagTagId"]);
				$beerTags[$beerTags->key()] = $beerTag;
				$beerTags->next();
			} catch(\Exception $exception) {
				//if the row cant be converted rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($beerTags);
	}

	/**
	 * gets the beer tag by tag Id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $beerTagTagId tag Id to search for
	 * @return \SplFixedArray of BeerTags found or null if nothing is found
	 * @throws \PDOException when mySQL related errors are found
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getBeerTagByTagId(\PDO $pdo, int $beerTagTagId) {
		// sanitize the tag id
		if($beerTagTagId < 0) {
			throw(new \PDOException ("Tag Id is not positive"));
		}
		//create query template
		$query = "SELECT beerTagBeerId, beerTagTagId FROM beerTag WHERE beerTagTagId = :beerTagTagId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the placeholders in the template
		$parameters = ["beerTagTagId" => $beerTagTagId];
		$statement->execute($parameters);

		//build an array of beer tags
		$beerTags = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$beerTag = new BeerTag($row["beerTagBeerId"], $row["beerTagTagId"]);
				$beerTags[$beerTags->key()] = $beerTag;
				$beerTags->next();
			} catch(\Exception $exception) {
				//if the row could not be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($beerTags);
	}

	//get beer tag by beer id and tag id
	/**
	 * gets the beer tag by both beer and tag id
	 * @param \PDO $pdo PDO connection object
	 * @param int $beerTagBeerID beer id to search for
	 * @param int $beerTagTagId tag id to search for
	 * @return BeerTag|null beerTag if found, null if not
	 * @throws \PDOException when mySQL errors occur
	 * @throws \TypeError when variables are not of the correct data type
	 **/
	public static function getBeerTagByBeerIdAndTagId(\PDO $pdo, int $beerTagBeerId, int $beerTagTagId) {
		//sanitize the beer id and the tag id before searching
		if($beerTagBeerId < 0) {
			throw (new \PDOException("beer id is not positive"));
		}
		if($beerTagTagId < 0) {
			throw (new \PDOException("tag id is not positive"));
		}

		//create a query template
		$query = "SELECT beerTagBeerId, beerTagTagId FROM beerTag WHERE beerTagBeerId = :beerTagBeerId AND beerTagTagId = :beerTagTagId;";
		$statement = $pdo->prepare($query);

		//bind the variables to the placeholders in the template
		$parameters = ["beerTagBeerId" => $beerTagBeerId, "beerTagTagId" => $beerTagTagId];
		$statement->execute($parameters);

		//grab the beer tag from mySQL
		try {
			$beerTag = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$beerTag = new BeerTag($row["beerTagBeerId"], $row["beerTagTagId"]);
			}
		} catch(\Exception $exception) {

			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($beerTag);
	}



	//jsonSerialize
	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return ($fields);
	}
}