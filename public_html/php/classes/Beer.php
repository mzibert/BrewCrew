<?php
namespace Edu\Cnm\BrewCrew;

require_once("autoload.php");

/**
 * This class contains data and functionality for beer
 *
 * @author Merri Zibert mjzibert2@gmail.com
 *
 **/
class Beer implements \JsonSerializable {
	/** Id for this beer is assigned by the system; this is the primary key.
	 * @var int $beerId
	 **/
	private $beerId;

	/** Id of the brewery that has this beer; this is the foreign key
	 * @var int $beerBreweryId
	 **/
	private $beerBreweryId;

	/** Actual percentage measurement for value of alcohol by volume
	 * @var float $beerAbv
	 **/
	private $beerAbv;

	/** string provided by the API to inform if and when beer is available
	 * @var string $beerAvailability
	 **/
	private $beerAvailability;

	/** text field provided by the API to reflect any awards the beer has earned
	 * @var string $beerAwards
	 **/
	private $beerAwards;

	/** Decimal number created on a scale from 0 to 1 to reflect beer color on a scale from 0 being darkest to 1 being lightest
	 * @var float $beerColor
	 **/
	private $beerColor;

	/**
	 * this is the primary key that breweryDB uses to identify beers, we need this validate/check data against the api
	 * @var string $beerDbKey
	 */
	private $beerDbKey;

	/** string of open text taken from the API used to describe the beer
	 * @var string $beerDescription
	 **/
	private $beerDescription;

	/** string usually numbers used to evaluate the quantitative value designated to the measurement of bitterness in beer.  Lower values less bitter, higher values more bitter.  However, some brewery use creative text descriptions instead
	 * @var string $beerIbu
	 **/
	private $beerIbu;

	/** string of open text for the name of the beer
	 * @var string $beerName
	 **/
	private $beerName;

	/** string used to capture the industry standard style label of the beer
	 * @var string
	 **/
	private $beerStyle;

	/**
	 * constructor for class beer
	 * @param int $newBeerId new value of beer id
	 * @param int $newBeerBreweryId new value of brewery id
	 * @param float $newBeerAbv new value of beer abv
	 * @param string $newBeerAvailability tells us if beer is available year round or seasonally
	 * @param string $newBeerAwards tells us all of the awards that this beer has been awarded
	 * @param float $newBeerColor new value of beer color between 0 and 1
	 * @param string $newBeerDbKey external api primary key value
	 * @param string $newBeerDescription tells about the details of the beer should not exceed 2000 characters
	 * @param string $newBeerIbu states how many Ibu's are present in the beer
	 * @param string $newBeerName displays the name of the beer
	 * @param string $newBeerStyle is used to assign industry style label
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of range (e.g., strings are too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(int $newBeerId = null, int $newBeerBreweryId, float $newBeerAbv, string $newBeerAvailability, string $newBeerAwards, float $newBeerColor, string $newBeerDbKey, string $newBeerDescription, string $newBeerIbu, string $newBeerName, string $newBeerStyle) {
		try {
			$this->setBeerId($newBeerId);
			$this->setBeerBreweryId($newBeerBreweryId);
			$this->setBeerAbv($newBeerAbv);
			$this->setBeerAvailability($newBeerAvailability);
			$this->setBeerAwards($newBeerAwards);
			$this->setBeerColor($newBeerColor);
			$this->setBeerDbKey($newBeerDbKey);
			$this->setBeerDescription($newBeerDescription);
			$this->setBeerIbu($newBeerIbu);
			$this->setBeerName($newBeerName);
			$this->setBeerStyle($newBeerStyle);
		} catch(\InvalidArgumentException $invalidArgument) {
			//rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			//rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			//rethrow the exception to the caller
			throw (new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			//rethrow the exception to the caller
			throw (new \Exception($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessors and mutators for class beer
	 **/

	/**
	 * accessor method for beer idbeer
	 *
	 * @return int value of beer id
	 **/
	public function getBeerId() {
		return ($this->beerId);
	}

	/**
	 *mutator method for beer id
	 *
	 * @param int|null $newBeerId new value of beer id
	 * @throws \RangeException if $newbeerId is not positive
	 * @throws \TypeError if $newBeerId is not an integer
	 **/
	public function setBeerId(int $newBeerId = null) {
		//when this is null, this is a new beer with no sql id yet
		if($newBeerId === null) {
			$this->beerId = null;
			return;
		}
		// verify the beer id is a positive number
		if($newBeerId <= 0) {
			throw (new \RangeException("beer Id is not a positive number"));
		}
		//convert and store the beer id
		$this->beerId = $newBeerId;
	}

	/**accessor method for brewery id
	 * @return int value of brewery id
	 **/
	public function getBeerBreweryId() {
		return ($this->beerBreweryId);
	}

	/**
	 * mutator method for brewery id
	 *
	 * @param int $newBeerBreweryId new value of brewery id
	 * @throws \RangeException if $newBeerBreweryId is not positive
	 * @throws \TypeError if $newBeerBreweryId is not an integer
	 **/
	public function setBeerBreweryId(int $newBeerBreweryId) {
		//verify the brewery id is positive
		if($newBeerBreweryId <= 0) {
			throw (new \RangeException("brewery id is not positive"));
		}
		//convert and store the new brewery id
		$this->beerBreweryId = $newBeerBreweryId;
	}

	/**
	 * accessor method for beer abv
	 * @return float value for beer abv
	 **/
	public function getBeerAbv() {
		return ($this->beerAbv);
	}

	/**
	 * mutator method for beer abv
	 *
	 * @param float $newBeerAbv new value of beer abv
	 * @throws \RangeException if $newbeerAbv is less than zero or greater than 100%
	 * @throws \TypeError if $newbeerAbv is not a float
	 **/
	public function setBeerAbv(float $newBeerAbv) {
		//verify the beer abv is between 0% and 100%
		if($newBeerAbv < 0 || $newBeerAbv > 100) {
			throw (new \RangeException ("beer abv is out of range"));
		}
		//convert and store the new beer abv
		$this->beerAbv = $newBeerAbv;
	}

	/**
	 * accessor method for beer availability
	 * @return string for beer availability
	 **/
	public function getBeerAvailability() {
		return ($this->beerAvailability);
	}

	/**
	 *mutator method for beer availablity
	 *
	 * @param string $newBeerAvailability tells us if beer is available year round or seasonally
	 * @throws \InvalidArgumentException if $newbeerAvailability is not a string or is insecure
	 * @throws \RangeException if $newbeerAvailability is > 100 characters
	 * @throws \TypeError if $newbeerAvailability is not a string
	 **/
	public function setBeerAvailability(string $newBeerAvailability) {
		//verify the beer availabilty content is secure
		$newBeerAvailability = trim($newBeerAvailability);
		$newBeerAvailability = filter_var($newBeerAvailability, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newBeerAvailability) === true) {
			throw(new \InvalidArgumentException("Beer availability content is either empty or insecure"));
		}
		//verify the beer availability content will fit in the database
		if(strlen($newBeerAvailability) > 100) {
			throw (new \RangeException("string is greater than 100 characters"));
		}
		//convert and store the new beer availability
		$this->beerAvailability = $newBeerAvailability;
	}

	/**
	 * accessor method for beer awards
	 * @return string value of beer awards
	 **/
	public function getBeerAwards() {
		return ($this->beerAwards);
	}

	/**
	 * mutator method for beer awards
	 * @param string $newBeerAwards tells us all of the awards that this beer has been awarded
	 * @throws \InvalidArgumentException if $newbeerAwards is not a string or is insecure
	 * @throws \RangeException if $newbeerAwards is greater that  1000 characters
	 * @throws \TypeError if $newbeerAwards is not a string
	 **/
	public function setBeerAwards(string $newBeerAwards) {
		//verify the beer awards content is secure
		$newBeerAwards = trim($newBeerAwards);
		$newBeerAwards = filter_var($newBeerAwards, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newBeerAwards) === true) {
			throw (new \InvalidArgumentException("beer awards content is either empty or insecure"));
		}
		//verify the beer awards content will fit in the
		// database
		if(strlen($newBeerAwards) > 1000) {
			throw (new \RangeException("beer awards description is greater than 1000 characters"));
		}
		//convert and store the new beer awards
		$this->beerAwards = $newBeerAwards;
	}

	/**
	 * accessor method for beer color
	 * @return float value of beer color
	 **/
	public function getBeerColor() {
		return ($this->beerColor);
	}

	/**mutator method for beer color
	 * @param float $newBeerColor new value of beer color between 0 and 1
	 * @throws \RangeException if $newbeerColor is less than zero or greater than 1
	 * @throws \TypeError if $newbeerColor is not a float
	 **/
	public function setBeerColor(float $newBeerColor) {
		//verify the beer abv is between 0 and 1
		if($newBeerColor < 0 || $newBeerColor > 1) {
			throw (new \RangeException ("beer color is out of range"));
		}
		//convert and store the new beer color
		$this->beerColor = $newBeerColor;
	}

	/**
	 * accessor method for beerDbKey
	 * @return string value for the external api key
	 **/
	public function getBeerDbKey() {
		return ($this->beerDbKey);
	}

	/**
	 * mutator method for beerDbKey
	 * @param string $newBeerDbKey external api key for this beer
	 * @throws \RangeException if the key is longer than six characters
	 * @throws \InvalidArgumentException if the $newBeerDbKey is not a string or is insecure
	 * @throws \TypeError if $newBeerDbKey is not a string
	 */

	public function setBeerDbKey($newBeerDbKey) {
		//verify that the breweryDbKey is secure
		$newBeerDbKey = trim($newBeerDbKey);
		$newBeerDbKey = filter_var($newBeerDbKey, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newBeerDbKey) === true) {
			throw(new \InvalidArgumentException("beerDbKey is empty or insecure"));
		}
		if(strlen($newBeerDbKey) > 6) {
			throw(new \RangeException("beerDbKey cannot be longer than 6 characters"));
		}
		//store the breweryDb key
		$this->beerDbKey = $newBeerDbKey;
	}

	/**
	 * accessor method for beer description
	 * @return string value of beer description
	 **/
	public function getBeerDescription() {
		return ($this->beerDescription);
	}

	/**
	 * mutator method for beer description
	 * @param string $newBeerDescription tells about the details of the beer should not exceed 2000 characters
	 * @throws \InvalidArgumentException if $newbeerDescription is not a string or is insecure
	 * @throws \RangeException if the string exceeds 2000 characters
	 **/
	public function setBeerDescription(string $newBeerDescription) {
		//verify the beer description content is secure
		$newBeerDescription = trim($newBeerDescription);
		$newBeerDescription = filter_var($newBeerDescription, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newBeerDescription) === true) {
			throw (new \InvalidArgumentException("beer description is either empty or insecure"));
		}
		if(strlen($newBeerDescription) > 2000) {
			throw (new \RangeException("beer description is greater than 2000 characters"));
		}
		//store the beer description content
		$this->beerDescription = $newBeerDescription;
	}

	/**
	 * accessor method for beer ibu
	 * @return string value for beer ibu
	 **/
	public function getBeerIbu() {
		return ($this->beerIbu);
	}

	/**
	 * mutator method for beerIbu
	 * @param string $newBeerIbu states how many Ibu's are present in the beer
	 * @throws \InvalidArgumentException if $newbeerIbu is not a string or is insecure
	 * @throws \RangeException if the string exceeds 50 characters
	 * @throws \TypeError if $newbeerIbu is not a string
	 **/
	public function setBeerIbu(string $newBeerIbu) {
		//verify the beer ibu content is secure
		$newBeerIbu = trim($newBeerIbu);
		$newBeerIbu = filter_var($newBeerIbu, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newBeerIbu) === true) {
			throw (new \InvalidArgumentException("beer IBU content is either empty or insecure"));
		}
		//verify the tweet content will fit in the database
		if(strlen($newBeerIbu) > 50) {
			throw (new \RangeException("beer IBU contains more than 50 characters"));
		}
		//store the beer IBU content
		$this->beerIbu = $newBeerIbu;
	}

	/**
	 * accessor method for beer name
	 * @return string for for beer name not null
	 **/
	public function getBeerName() {
		return ($this->beerName);
	}

	/**
	 * mutator method for beer name
	 * @param string $newBeerName displays the name of the beer
	 * @throws \InvalidArgumentException if $newbeerName is not a string or is insecure
	 * @throws \RangeException if string exceeds 64 characters
	 * @throws \TypeError if $newbeerName is not a string
	 **/
	public function setBeerName(string $newBeerName) {
		//verify the beer name content is secure
		$newBeerName = trim($newBeerName);
		$newBeerName = filter_var($newBeerName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newBeerName) === true) {
			throw(new \InvalidArgumentException("beer name is either empty or insecure"));
		}
		//verify the beer name content will fit in the database
		if(strlen($newBeerName) > 64) {
			throw (new \RangeException("beer name contains more than 64 characters"));
		}
		//store the beer name
		$this->beerName = $newBeerName;
	}

	/**
	 * accessor method for beer style
	 * @return string to describe industry style label
	 **/
	public function getBeerStyle() {
		return ($this->beerStyle);
	}

	/**
	 * mutator method for beer stlye
	 * @param string $newBeerStyle is used to assign industry style label
	 * @throws \InvalidArgumentException if $newbeerStyle content is not a string or is insecure
	 * @throws \RangeException if string exceeds 32 characters
	 **/
	public function setBeerStyle(string $newBeerStyle) {
		//verify the beer style content is secure
		$newBeerStyle = trim($newBeerStyle);
		$newBeerStyle = filter_var($newBeerStyle, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newBeerStyle) === true) {
			throw (new \InvalidArgumentException("beer style content is either empty or insecure"));
		}
		//verify the content of beer style can fit in the database
		if(strlen($newBeerStyle) > 32) {
			throw (new \RangeException("beer style is greater than 32 characters"));
		}
		//store the beer style content
		$this->beerStyle = $newBeerStyle;
	}

	/**
	 * inserts this Beer into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when my SQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		//enforce the beerId is null (i.e., dont insert a beer that already exists)
		if($this->beerId !== null) {
			throw (new \PDOException("not a new beer"));
		}
		//create query template
		$query = "INSERT INTO beer(beerBreweryId, beerAbv, beerAvailability, beerAwards, beerColor, beerDbKey, beerDescription, beerIbu, beerName, beerStyle) VALUES (:beerBreweryId, :beerAbv, :beerAvailability, :beerAwards, :beerColor, :beerDbKey, :beerDescription, :beerIbu, :beerName, :beerStyle)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["beerBreweryId" => $this->beerBreweryId, "beerAbv" => $this->beerAbv, "beerAvailability" => $this->beerAvailability, "beerAwards" => $this->beerAwards, "beerColor" => $this->beerColor, "beerDbKey" => $this->beerDbKey, "beerDescription" => $this->beerDescription, "beerIbu" => $this->beerIbu, "beerName" => $this->beerName, "beerStyle" => $this->beerStyle];
		$statement->execute($parameters);

		//update the null beerId with what my SQL just gave us
		$this->beerId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes this beer from mySQL
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occure
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		//enforce the beerID is not null (i.e., don't delete a beer that has not been inserted)
		if($this->beerId === null) {
			throw (new \PDOException("unable to delete a beer that does not exist"));
		}

		//create a query template
		$query = "DELETE FROM beer WHERE beerId = :beerId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holder in the template
		$parameters = ["beerId" => $this->beerId];
		$statement->execute($parameters);
	}

	/**
	 * updates this Beer in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		//enforce the beerID is not null (i.e., do not update a beer that has not been inserted)
		if($this->beerId === null) {
			throw(new \PDOException("unable to update a beer that does not exist"));
		}

		//create query template
		$query = "UPDATE beer SET beerBreweryId = :beerBreweryId, beerAbv = :beerAbv, beerAvailability = :beerAvailability, beerAwards = :beerAwards, beerColor = :beerColor, beerDbKey = :beerDbKey, beerDescription = :beerDescription, beerIbu = :beerIbu, beerName =:beerName, beerStyle = :beerStyle WHERE beerId = :beerId";
		$statement = $pdo->prepare($query);
		//bind the member variables to the place holders in the template
		$parameters = ["beerBreweryId" => $this->beerBreweryId, "beerAbv" => $this->beerAbv, "beerAvailability" => $this->beerAvailability, "beerAwards" => $this->beerAwards, "beerColor" => $this->beerColor, "beerDbKey" => $this->beerDbKey, "beerDescription" => $this->beerDescription, "beerIbu" => $this->beerIbu, "beerName" => $this->beerName, "beerStyle" => $this->beerStyle, "beerId" => $this->beerId];
		$statement->execute($parameters);
	}

	/**
	 * gets the Beer by beer ID
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $beerId the beerId to search for
	 * @return \Beer|null either the beer or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getBeerByBeerId(\PDO $pdo, int $beerId) {
		//sanitize the beer id before searching
		$beerId = filter_var($beerId, FILTER_SANITIZE_NUMBER_INT);
		if($beerId === false) {
			throw(new \PDOException("beer Id is not an integer"));
		}
		if($beerId <= 0) {
			throw (new\PDOException("Beer id is not positive"));
		}
		//create query template
		$query = "SELECT beerId, beerBreweryId, beerAbv, beerAvailability, beerAwards, beerColor, beerDbKey, beerDescription, beerIbu, beerName, beerStyle FROM beer WHERE beerId = :beerId";
		$statement = $pdo->prepare($query);

		//bind the beer id to the place holder in the template
		$parameters = array("beerId" => $beerId);
		$statement->execute($parameters);

		//grab the beer from mySQL
		try {
			$beer = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$beer = new Beer($row["beerId"], $row["beerBreweryId"], $row["beerAbv"], $row["beerAvailability"], $row["beerAwards"], $row["beerColor"], $row["beerDbKey"], $row["beerDescription"], $row["beerIbu"], $row["beerName"], $row["beerStyle"]);
			}
		} catch(\Exception $exception) {
			//if the row couldnt be converted rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($beer);
	}

	/**
	 * gets the beer by brewery id
	 * @param \PDO $pdo PDO connection object
	 * @param int $breweryId the brewery Id to search for
	 * @return \SplFixedArray  an array of beers or null if not found
	 * @throws \PDOException when mySQL errors are found
	 * @throws \TypeError when the variable returned is not an integer
	 **/
	public static function getBeerByBeerBreweryId(\PDO $pdo, int $beerBreweryId) {
		//sanitize the brewery id before searching
		if($beerBreweryId <= 0) {
			throw(new \PDOException("brewery Id is not positive"));
		}
		//create a query template
		$query = "SELECT beerId, beerBreweryId, beerAbv, beerAvailability, beerAwards, beerColor, beerDbKey, beerDescription, beerIbu, beerName, beerStyle FROM beer WHERE beerBreweryId = :beerBreweryId";
		$statement = $pdo->prepare($query);

		//bind the brewery id to the placeholder in the template
		$parameters = array("beerBreweryId" => $beerBreweryId);
		$statement->execute($parameters);

		//build an array of beers
		$beers = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$beer = new Beer($row["beerId"], $row["beerBreweryId"], $row["beerAbv"], $row["beerAvailability"], $row["beerAwards"], $row["beerColor"], $row["beerDbKey"], $row["beerDescription"], $row["beerIbu"], $row["beerName"], $row["beerStyle"]);
				$beers[$beers->key()] = $beer;
				$beers->next();
			} catch(\Exception $exception) {

				//If the row couldnt be converted, rethrow it
				throw (new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($beers);
	}

	/**
	 * gets the beer by beerIbu
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $beerIbu to search for beers by Ibu
	 * @return \SplFixedArray SplFixedArray of beers found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getBeerByBeerIbu(\PDO $pdo, string $beerIbu) {
		//sanitize the description before searching
		$beerIbu = trim($beerIbu);
		$beerIbu = filter_var($beerIbu, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($beerIbu) === true) {
			throw (new \PDOException("beer ibu is invalid"));
		}

		//create query template
		$query = "SELECT beerId, beerBreweryId, beerAbv, beerAvailability, beerAwards, beerColor, beerDbKey, beerDescription, beerIbu, beerName, beerStyle FROM beer WHERE beerIbu LIKE :beerIbu";
		$statement = $pdo->prepare($query);

		//bind the beer Ibu to the place holder in the template
		$beerIbu = "%$beerIbu%";
		$parameters = array("beerIbu" => $beerIbu);
		$statement->execute($parameters);

		//build an array of beers
		$beers = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$beer = new Beer($row["beerId"], $row["beerBreweryId"], $row["beerAbv"], $row["beerAvailability"], $row["beerAwards"], $row["beerColor"], $row["beerDbKey"], $row["beerDescription"], $row["beerIbu"], $row["beerName"], $row["beerStyle"]);
				$beers[$beers->key()] = $beer;
				$beers->next();
			} catch(\Exception $exception) {
				//if the row couldnt be converted, rethrow it
				throw (new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($beers);
	}

	/**
	 * gets the beer by beerColor
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param float $beerColor to search for beers by color
	 * @return \SplFixedArray SplFixedArray of beers found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getBeerByBeerColor(\PDO $pdo, float $beerColor) {
		//check that the beer color is 0 to 1
		if($beerColor < 0 || $beerColor > 1) {
			throw (new \RangeException("beer color must be between 0 and 1"));
		}

		//create query template
		$query = "SELECT beerId, beerBreweryId, beerAbv, beerAvailability, beerAwards, beerColor, beerDbKey, beerDescription, beerIbu, beerName, beerStyle FROM beer WHERE beerColor = :beerColor";
		$statement = $pdo->prepare($query);

		//bind the beer color to the place holder in the template
		$parameters = array("beerColor" => $beerColor);
		$statement->execute($parameters);

		//build an array of beers
		$beers = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$beer = new Beer($row["beerId"], $row["beerBreweryId"], $row["beerAbv"], $row["beerAvailability"], $row["beerAwards"], $row["beerColor"], $row["beerDbKey"], $row["beerDescription"], $row["beerIbu"], $row["beerName"], $row["beerStyle"]);
				$beers[$beers->key()] = $beer;
				$beers->next();
			} catch(\Exception $exception) {
				//if the row couldnt be converted, rethrow it
				throw (new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($beers);
	}

	/**
	 * gets the beer by beerDbKey
	 * @param \Pdo $pdo PDO connection object
	 * @param string $beerDbKey beer beerDB key used to identify the beer
	 * @return Beer|null returns either a beer or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getBeerByBeerDbKey(\PDO $pdo, string $beerDbKey) {
		//sanitize the beerDbKey before searching
		$beerDbKey = trim($beerDbKey);
		$beerDbKey = filter_var($beerDbKey, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($beerDbKey) === true) {
			throw(new \PDOException("beerDbKey is invalid"));
		}

		//create the query template
		$query = "SELECT beerId, beerBreweryId, beerAbv, beerAvailability, beerAwards, beerColor, beerDbKey, beerDescription, beerIbu, beerName, beerStyle FROM beer WHERE beerDbKey LIKE :beerDbKey";
		$statement = $pdo->prepare($query);

		//bind the beerDbKey to the placeholder in the template
		$parameters = array("beerDbKey" => $beerDbKey);
		$statement->execute($parameters);

		//grab the beer from mySQL
		try {
			$beer = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$beer = new Beer($row["beerId"], $row["beerBreweryId"], $row["beerAbv"], $row["beerAvailability"], $row["beerAwards"], $row["beerColor"], $row["beerDbKey"], $row["beerDescription"], $row["beerIbu"], $row["beerName"], $row["beerStyle"]);
			}
		} catch(\Exception $exception) {
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($beer);
	}

	/**
	 * gets the beer by beerName
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $beerName to search for beers by Name
	 * @return \SplFixedArray SplFixedArray of beers found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getBeerByBeerName(\PDO $pdo, string $beerName) {
		//sanitize the description before searching
		$beerName = trim($beerName);
		$beerName = filter_var($beerName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($beerName) === true) {
			throw (new \PDOException("beer name is either too long or insecure"));
		}

		//create query template
		$query = "SELECT beerId, beerBreweryID, beerAbv, beerAvailability, beerAwards, beerColor, beerDbKey, beerDescription, beerIbu, beerName, beerStyle FROM beer WHERE beerName LIKE :beerName";
		$statement = $pdo->prepare($query);

		//bind the beer Ibu to the place holder in the template
		$beerName = "%$beerName%";
		$parameters = array("beerName" => $beerName);
		$statement->execute($parameters);

		//build an array of beers
		$beers = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$beer = new Beer($row["beerId"], $row["beerBreweryID"], $row["beerAbv"], $row["beerAvailability"], $row["beerAwards"], $row["beerColor"], $row["beerDbKey"], $row["beerDescription"], $row["beerIbu"], $row["beerName"], $row["beerStyle"]);
				$beers[$beers->key()] = $beer;
				$beers->next();
			} catch(\Exception $exception) {
				//if the row couldnt be converted, rethrow it
				throw (new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($beers);
	}

	/**
	 * gets the beer by beerStyle
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $beerStyle to search for beers by Ibu
	 * @return \SplFixedArray SplFixedArray of beers found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getBeerByBeerStyle(\PDO $pdo, string $beerStyle) {
		//sanitize the description before searching
		$beerStyle = trim($beerStyle);
		$beerStyle = filter_var($beerStyle, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($beerStyle) === true) {
			throw (new \PDOException("beer style is either too long or insecure"));
		}

		//create query template
		$query = "SELECT beerId, beerBreweryID, beerAbv, beerAvailability, beerAwards, beerColor, beerDbKey, beerDescription, beerIbu, beerName, beerStyle FROM beer WHERE beerStyle LIKE :beerStyle";
		$statement = $pdo->prepare($query);

		//bind the beer Ibu to the place holder in the template
		$beerStyle = "%$beerStyle%";
		$parameters = array("beerStyle" => $beerStyle);
		$statement->execute($parameters);

		//build an array of beers
		$beers = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$beer = new Beer($row["beerId"], $row["beerBreweryID"], $row["beerAbv"], $row["beerAvailability"], $row["beerAwards"], $row["beerColor"], $row["beerDbKey"], $row["beerDescription"], $row["beerIbu"], $row["beerName"], $row["beerStyle"]);
				$beers[$beers->key()] = $beer;
				$beers->next();
			} catch(\Exception $exception) {
				//if the row couldnt be converted, rethrow it
				throw (new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($beers);
	}

	/**
	 * gets the beer by Alicia Awesome *mic drop*
	 * @param \PDO $pdo PDO connection object
	 * @param int $userId userId that is getting recommendation
	 * @return JsonObjectStorage  an array of beers that can be JsonSerialized
	 * @throws \PDOException when mySQL errors are found
	 * @throws \TypeError when the variable returned is not an integer
	 **/
	public static function getBeerByAliciaAwesome(\PDO $pdo, int $userId) {
		//sanitize the brewery id before searching
		if($userId <= 0) {
			throw(new \PDOException("user Id is not positive"));
		}
		//create a query template
		$query = "CALL recommendation(:userId)";
		$statement = $pdo->prepare($query);

		//bind the brewery id to the placeholder in the template
		$parameters = array("userId" => $userId);
		$statement->execute($parameters);

		//build an array of beers
//		$beers = new \SplFixedArray($statement->rowCount());
		$beerMap = new JsonObjectStorage();
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$beer = new Beer($row["beerId"], $row["beerBreweryId"], $row["beerAbv"], $row["beerAvailability"], $row["beerAwards"], $row["beerColor"], $row["beerDbKey"], $row["beerDescription"], $row["beerIbu"], $row["beerName"], $row["beerStyle"]);
				$beerMap->attach($beer, $row["beerDrift"]);
//				$beers[$beers->key()] = $beer;
//				$beers->next();
			} catch(\Exception $exception) {

				//If the row couldnt be converted, rethrow it
				throw (new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($beerMap);
	}


	//jsonSerialize
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return ($fields);
	}
}
