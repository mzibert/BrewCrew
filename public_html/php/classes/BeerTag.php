<?php
namespace Edu\Cnm\BrewCrew;

require_once ("autoload.php");

/**
 * Class BeerTag
 * This class contains everything for a user to be able to link beer flavor tags with the beers that they drink
 * @author Merri Zibert <mzibert@cnm.edu>
 **/

class BeerTag {
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
	 * @throws \TypeError if the data entered is the incorrect type
	 * @throws \Exception if any other type of errors occur
	 **/
	public function __construct(int $newBeerTagBeerId, int $newBeerTagTagId) {
		try {
			$this->setBeerTagBeerId($newBeerTagBeerId);
			$this->setBeerTagTagId($newBeerTagTagId);
		} catch(\InvalidArgumentException $InvalidArgument){
			//rethrow the exception to the caller
			throw (\InvalidArgumentException($InvalidArgument->getMessage(), 0, $InvalidArgument));
		} catch(\RangeException $range) {
			//rethrow the exception to the caller
			throw (new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			//rethrow exception to the caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\ Exception $exception) {
			throw (new \Exception($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessors and mutators for class beerTag
	 */
	/**
	 * accessor method for beerTagBeerId
	 * @return int value of beerTag BeerId, foreign key
	 **/
	public function getBeerTagBeerId() {
		return ($this->beerTagBeerId);
	}

	/**
	 * mutator method for beerTagBeerId
	 * @param int $newBeerTagBeerId new value of beerTag beerId
	 * @throws \RangeException if $newBeerTagBeerId is not positive
	 * @throws \TypeError if $newBeerTagBeerId is not an integer
	 **/
	public function setBeerTagBeerId($newBeerTagBeerId) {
		//verify the beer tag beer id content is positive
		if($newBeerTagBeerId <= 0) {
			throw (new \RangeException("beer tag beer id is not positive"));
		}
		// convert and store the new beer tag beer id
		$this->beerTagBeerId = $newBeerTagBeerId;
	}

	/**
	 * accessor method for beerTagTagId
	 * @return int value of beerTag tagId, foreign key
	 **/
	public function getBeerTagTagId() {
		return ($this->beerTagTagId);
	}

	/**
	 * mutator method for beerTag tagId
	 * @param int $newBeerTagTagId new value of the tag id assigned to this beer
	 * @throws \RangeException if $newBeerTagTagId is not positive
	 * @throws \TypeError if $newBeerTagTagId is not an integer
	 **/
	public function setBeerTagTagId($newBeerTagTagId) {
		//verify the beer tag tag Id content is positive
		if($newBeerTagTagId <= 0) {
			throw (new \RangeException("beer tag tag Id is not positive"));
		}
		//convert and store the beer tag tag Id
		$this->beerTagTagId = $newBeerTagTagId;
	}
	/**
	 * inserts this beer tag into mySQL
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		//check that the beer tag exists before inserting into SQL
		if($this->beerTagBeerId === null || $this->beerTagTagId === null){
			throw (new \PDOException("beer or tag not valid"));
		}
		//create query template
		$query = "INSERT INTO beerTag(beerTagBeerId, beerTagTagId) VALUES (:beerTagBeerId, :beerTagTagId)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["beerTagBeerId" => $this->beerTagBeerId, "beerTagTagId" => $this->beerTagTagId];
		$statement->execute($parameters);
		//update the null beerId with what my SQL just gave us
		
		
	}
}

/**
 * deletes this beer tag from mySQL
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occure
 * @throws \TypeError if $pdo is not a PDO connection object
 **/

//enforce the beerTagID is not null (i.e., don't delete a beer tag that has not been inserted)

//create a query template

//bind the member variables to the place holder in the template


/**
 * updates this Beer Tag in mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/

//create query template

//bind the member variables to the place holders in the template

/**
 * gets the Beer Tag by beerTag ID
 *
 * @param \PDO $pdo PDO connection object
 * @param int $beerId the beerId to search for
 * @return \Beer|null either the beer or null if not found
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError when variables are not the correct data type
 **/

//create query template

//bind the beer id to the place holder in the template

//grab the beer from mySQL