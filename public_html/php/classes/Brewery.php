<?php

namespace Edu\Cnm\BrewCrew;
require_once("autoload.php");

/**
 * This class contains data and functionality for a brewery.
 *
 * @author Kate McGaughey therealmcgaughey@gmail.com
 */

class Brewery implements \JsonSerializable {

	/**
	 * ID for the brewery; this is the primary key
	 * @var int $breweryId
	 */
	private $breweryId;

	/**
	 * this is the primary key that breweryDB uses to identify breweries, we need this to get the data from the api for beers
	 * @var string $breweryDbKey
	 */
	private $breweryDbKey;

	/**
	 * description of the brewery
	 * @var string $breweryDescription
	 **/
	private $breweryDescription;

	/**
	 * year brewery was established
	 * @var |Year $breweryEstDate
	 */
	private $breweryEstDate;

	/**
	 * brewery hours
	 * @var string $breweryHours
	 */
	private $breweryHours;

	/**
	 * brewery address
	 * @var string $breweryLocation
	 */
	private $breweryLocation;

	/**
	 * name of brewery
	 * @var string $breweryName
	 */
	private $breweryName;

	/**
	 * brewery phone number
	 * @var string $breweryPhone
	 */
	private $breweryPhone;

	/**
	 * website of brewery
	 * @var string $breweryUrl
	 */
	private $breweryUrl;

	/** Constructor for this Brewery
	 *
	 * @param int|null $newBreweryId id of this brewery or null if a new brewery
	 * @param string $newBreweryDbKey string for the key from breweryDB
	 * @param string $newBreweryDescription string of open text taken from the API used to describe the brewery
	 * @param |Year $newBreweryEstDate date brewery was established
	 * @param string $newBreweryHours an array of brewery's hours
	 * @param string $newBreweryLocation string containing brewery location
	 * @param string $newBreweryName string containing brewery name
	 * @param string $newBreweryPhone phone number of the brewery
	 * @param string $newBreweryUrl string containing website of the brewery
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
		 */
	public function __construct(int $newBreweryId = null, string $newBreweryDbKey, string $newBreweryDescription, $newBreweryEstDate, string $newBreweryHours, string $newBreweryLocation, string $newBreweryName, string $newBreweryPhone, string $newBreweryUrl) {
		try {
			$this->setBreweryId($newBreweryId);
			$this->setBreweryDbKey($newBreweryDbKey);
			$this->setBreweryDescription($newBreweryDescription);
			$this->setBreweryEstDate($newBreweryEstDate);
			$this->setBreweryHours($newBreweryHours);
			$this->setBreweryLocation($newBreweryLocation);
			$this->setBreweryName($newBreweryName);
			$this->setBreweryPhone($newBreweryPhone);
			$this->setBreweryUrl($newBreweryUrl);
		} catch(\InvalidArgumentException $invalidArgument) {
			// Rethrow exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			// Rethrow exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			//rethrow the exception to the caller
			throw (new \TypeError($typeError->getMessage(), 0, $typeError));
		}catch(\Exception $exception) {
			// Rethrow exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/** Accessor method for breweryId
	 *
	 * @return int|null value of Brewery id
	 **/
	public function getBreweryId() {
		return ($this->breweryId);
	}

	/** Mutator method for breweryId
	 *
	 * @param int $newBreweryId new value of brewery Id
	 * @throws \RangeException if $newBreweryId is not positive
	 * @throws \TypeError if $newBreweryId is not an integer
	 */
	public function setBreweryId(int $newBreweryId = null) {
		//base case: If breweryId is null, this is a new brewery without a mySQL assigned id yet
		if($newBreweryId === null) {
			$this->breweryId = null;
			return;
		}
		//verify the brewery id is positive
		if($newBreweryId <= 0) {
			throw (new \RangeException("brewery id is not positive"));
		}
		//convert and store the brewery id
		$this->breweryId = $newBreweryId;
	}

	/** Accessor method for breweryDbKey
	 *
	 * @return string value of BreweryDbKey
	 **/
	public function getBreweryDbKey() {
		return ($this->breweryDbKey);
	}

	/** Mutator method for breweryDbKey
	 *
	 * @param string $newBreweryDbKey new value for the breweryDbKey
	 * @throws \RangeException if $newBreweryDbKey is longer than 6 characters
	 * @throws \TypeError if $newBreweryDbKey is not a string
	 */
	public function setBreweryDbKey($newBreweryDbKey) {
		//verify that the breweryDbKey is secure
		$newBreweryDbKey = trim($newBreweryDbKey);
		$newBreweryDbKey = filter_var($newBreweryDbKey, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if (empty($newBreweryDbKey) === true) {
			throw(new \InvalidArgumentException("breweryDbKey is empty or insecure"));
		}
		if(strlen($newBreweryDbKey) > 6) {
			throw(new \RangeException("breweryDbKey cannot be longer than 6 characters"));
		}
		//store the breweryDb key
		$this->breweryDbKey = $newBreweryDbKey;
	}

	/** Acceesor method for breweryDescription
	 *
	 * @return string for brewery description
	 **/
	public function getBreweryDescription() {
		return ($this->breweryDescription);
	}

	/** Mutator method for breweryDescription
	 * @param string $newBreweryDescription gives detailed description of brewery from API limited to 1000 characters
	 * @throws \InvalidArgumentException if $newBreweryDescription is not a string or is insecure
	 * @throws \RangeException if string exceeds 1000 characters
	 **/
	public function setBreweryDescription($newBreweryDescription) {
		//verify the brewery description content is secure
		$newBreweryDescription = trim($newBreweryDescription);
		$newBreweryDescription = filter_var($newBreweryDescription, FILTER_SANITIZE_STRING);
		if(empty($newBreweryDescription) === true) {
			throw (new \InvalidArgumentException("brewery description is empty or insecure"));
		}
		if(strlen($newBreweryDescription) > 5000) {
//			throw (new \RangeException("brewery description is greater than 1000 characters"));
			substr($newBreweryDescription, 0, 5000);
		}
		//store the brewery description content
		$this->breweryDescription = $newBreweryDescription;
	}

	/** Accessor method for breweryEstDate
	 *
	 * @return year year brewery was established
	 **/
	public function getBreweryEstDate() {
		return ($this->breweryEstDate);
	}

	/** Mutator method for breweryEstDate
	 *
	 * @param year $newBreweryEstDate gives year brewery was founded
	 * @throws \InvalidArgumentException if $newBreweryEstDate is not a year YYYY
	 * @throws \RangeException if year exceeds 4 characters
	 * @link http://dev.mysql.com/doc/refman/5.5/en/year.html for year type info
	 **/
	public function setBreweryEstDate($newBreweryEstDate) {
		// verify the brewery year content is secure
		$newBreweryEstDate = trim($newBreweryEstDate);
		$newBreweryEstDate = filter_var($newBreweryEstDate, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newBreweryEstDate) === true) {
			throw (new \InvalidArgumentException("brewery est date is empty or insecure"));
		}
		// verify the brewery est date is at least 1901
		if($newBreweryEstDate < 1901) {
			throw(new \RangeException("year must be at least 1901"));
		}
		// verify the brewery est date is no later than 2155
		if($newBreweryEstDate > 2155) {
			throw (new \RangeException("brewery cannot be from the future"));
		}
		// store the brewery est date content
		$this->breweryEstDate = $newBreweryEstDate;
	}

	/** Accessor method for brewery hours
	 *
	 * @return string brewery hours
	 **/
	public function getBreweryHours() {
		return ($this->breweryHours);
	}

	/** Mutator method for brewery hours
	 *
	 * @param string $newBreweryHours new value of hours of operation
	 * @throws \InvalidArgumentException if $newBreweryHours is not a string or is insecure
	 * @throws \RangeException if string exceeds 250 characters
	 **/
	public function setBreweryHours($newBreweryHours) {
		//verify the brewery description content is secure
		$newBreweryHours = trim($newBreweryHours);
		$newBreweryHours = filter_var($newBreweryHours, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newBreweryHours) === true) {
			throw (new \InvalidArgumentException("brewery hours field is empty or insecure"));
		}
		if(strlen($newBreweryHours) > 1000) {
//			throw (new \RangeException("brewery hours field is greater than 250 characters"));
			substr($newBreweryHours, 0, 1000);
		}
		//store the brewery hours content
		$this->breweryHours = $newBreweryHours;
	}

	/** Accessor method for brewery location
	 *
	 * @return string brewery location
	 **/
	public function getBreweryLocation() {
		return ($this->breweryLocation);
	}

	/** Mutator method for brewery location
	 *
	 * @param string $newBreweryLocation new value of address
	 * @throws \InvalidArgumentException if $newBreweryLocation is not a string or is insecure
	 * @throws \RangeException if string exceeds 250 characters
	 **/
	public function setBreweryLocation($newBreweryLocation) {
		//verify the brewery location content is secure
		$newBreweryLocation = trim($newBreweryLocation);
		$newBreweryLocation = filter_var($newBreweryLocation, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newBreweryLocation) === true) {
			throw (new \InvalidArgumentException("brewery location is empty or insecure"));
		}
		if(strlen($newBreweryLocation) > 250) {
			throw (new \RangeException("brewery location field is greater than 250 characters"));
		}
		//store the brewery location content
		$this->breweryLocation = $newBreweryLocation;
	}

	/** Accessor method for brewery name
	 *
	 * @return string name of brewery
	 **/
	public function getBreweryName() {
		return ($this->breweryName);
	}

	/** Mutator method for brewery location
	 *
	 * @param string $newBreweryName new value of name
	 * @throws \InvalidArgumentException if $newBreweryName is not a string or is insecure
	 * @throws \RangeException if string exceeds 100 characters
	 **/
	public function setBreweryName($newBreweryName) {
		//verify the brewery name content is secure
		$newBreweryName = trim($newBreweryName);
		$newBreweryName = filter_var($newBreweryName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newBreweryName) === true) {
			throw (new \InvalidArgumentException("brewery name is empty or insecure"));
		}
		if(strlen($newBreweryName) > 100) {
			throw (new \RangeException("brewery name field is greater than 100 characters"));
		}
		//store the brewery name content
		$this->breweryName = $newBreweryName;
	}

	/** Accessor method for brewery phone
	 *
	 * @return string brewery phone
	 **/
	public function getBreweryPhone() {
		return ($this->breweryPhone);
	}

	/** Mutator method for brewery phone
	 *
	 * @param string $newBreweryPhone new value of phone number
	 * @throws \InvalidArgumentException if $newBreweryPhone is not a string or is insecure
	 * @throws \RangeException if string exceeds 20 characters
	 **/
	public function setBreweryPhone($newBreweryPhone) {
		//verify the brewery phone content is secure
		$newBreweryPhone = trim($newBreweryPhone);
		$newBreweryPhone = filter_var($newBreweryPhone, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newBreweryPhone) === true) {
			throw (new \InvalidArgumentException("brewery phone is empty or insecure"));
		}
		if(strlen($newBreweryPhone) > 20) {
			throw (new \RangeException("brewery phone field is greater than 20 characters"));
		}
		//store the brewery phone content
		$this->breweryPhone = $newBreweryPhone;
	}

	/** Accessor method for brewery URL
	 *
	 * @return string brewery website
	 **/
	public function getBreweryUrl() {
		return ($this->breweryUrl);
	}

	/** Mutator method for brewery URL
	 *
	 * @param string $newBreweryUrl new value of brewery website
	 * @throws \InvalidArgumentException if $newBreweryUrl is not a string or is insecure
	 * @throws \RangeException if string exceeds 250 characters
	 **/
	public function setBreweryUrl($newBreweryUrl) {
		//verify the brewery URL content is secure
		$newBreweryUrl = trim($newBreweryUrl);
		$newBreweryUrl = filter_var($newBreweryUrl, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newBreweryUrl) === true) {
			throw (new \InvalidArgumentException("brewery URL is empty or insecure"));
		}
		if(strlen($newBreweryUrl) > 250) {
			throw (new \RangeException("brewery URL field is greater than 250 characters"));
		}
		//store the brewery URL content
		$this->breweryUrl = $newBreweryUrl;
	}
// PDO
	/**
	 * Inserts this brewery into mySQL
	 *
	 * @link //From here to the end, I used Skyler's work as a model: https://github.com/Skylarity/trufork/blob/master/public_html/php/classes/restaurant.php
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL-related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		// Make sure this is a new brewery
		if($this->breweryId !== null) {
			throw(new \PDOException("Not a new brewery"));
		}
		// Crete query template
		$query = "INSERT INTO brewery(breweryId, breweryDbKey, breweryDescription, breweryEstDate, breweryHours, breweryLocation, breweryName, breweryPhone, breweryUrl) VALUES(:breweryId, :breweryDbKey, :breweryDescription, :breweryEstDate, :breweryHours, :breweryLocation, :breweryName, :breweryPhone, :breweryUrl)";
		$statement = $pdo->prepare($query);

		// Bind the member variables to the place holders in the template
		$parameters = ["breweryId" => $this->getBreweryId(), "breweryDbKey" => $this->getBreweryDbKey(),  "breweryDescription" => $this->getBreweryDescription(), "breweryEstDate" => $this->getBreweryEstDate(), "breweryHours" => $this->getBreweryHours(), "breweryLocation" => $this->getBreweryLocation(), "breweryName" => $this->getBreweryName(), "breweryPhone" => $this->getBreweryPhone(), "breweryUrl" => $this->getBreweryUrl()];
		$statement->execute($parameters);

		// Update the null brewery id with what mySQL generated
		$this->setBreweryId(intval($pdo->lastInsertId()));
	}

	/**
	 * Deletes this brewery from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL-related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		// Make sure this brewery exists
		if($this->breweryId === null) {
			throw (new \PDOException("Unable to delete a brewery that does not exist"));
		}
		// Create query template
		$query = "DELETE FROM brewery WHERE breweryId = :breweryId"; 
		$statement = $pdo->prepare($query);

		// Bind the member variables to the placeholders in the partials
		$parameters = ["breweryId" => $this->getBreweryId()];
		$statement->execute($parameters);
	}

	/**
	 * Updates this brewery in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL-related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 * **/
	public function update(\PDO $pdo) {
		// Make sure this brewery exists
		if($this->breweryId === null) {
			throw(new \PDOException("Unable to update a brewery that does not exist"));
		}
		// Create query template
		$query = "UPDATE brewery SET breweryDbKey = :breweryDbKey, breweryDescription = :breweryDescription, breweryEstDate = :breweryEstDate, breweryHours = :breweryHours, breweryLocation = :breweryLocation, breweryName = :breweryName, breweryPhone = :breweryPhone, breweryUrl = :breweryUrl WHERE breweryId = :breweryId";
		$statement = $pdo->prepare($query);

		//Bind the member variables to the placeholders in the partials
		$parameters = ["breweryId" => $this->getBreweryId(), "breweryDbKey" => $this->getBreweryDbKey(), "breweryDescription" => $this->getBreweryDescription(), "breweryEstDate" => $this->getBreweryEstDate(), "breweryHours" => $this->getBreweryHours(), "breweryLocation" => $this->getBreweryLocation(), "breweryName" => $this->getBreweryName(), "breweryPhone" => $this->getBreweryPhone(), "breweryUrl" => $this->getBreweryUrl()];
		$statement->execute($parameters);
	}

	/**
	 * Gets the brewery by breweryId
	 *
	 * @param \PDO $pdo $pdo PDO connection object
	 * @param int $breweryId brewery id to search for
	 * @return Brewery|null either brewery or null if not found
	 * @throws \PDOException when mySQL-related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 * **/
	public static function getBreweryByBreweryId(\PDO $pdo, int $breweryId) {
		// Sanitize the breweryId before searching
		$breweryId = filter_var($breweryId, FILTER_SANITIZE_NUMBER_INT);
		if($breweryId === false) {
			throw(new \PDOException("Brewery ID is not an integer"));
		}
		if($breweryId <= 0) {
			throw(new \PDOException('Brewery ID is not positive:'));
		}
		// Create query template
		$query = "SELECT breweryId, breweryDbKey, breweryDescription, breweryEstDate, breweryHours, breweryLocation, breweryName, breweryPhone, breweryUrl FROM brewery WHERE breweryId = :breweryId";
		$statement = $pdo->prepare($query);

		//Bind the breweryId to the place holder in the template
		$parameters = array("breweryId" => $breweryId);
		$statement->execute($parameters);

		//Grab the brewery from mySQL
		try {
			$brewery = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$brewery = new Brewery($row["breweryId"], $row["breweryDbKey"], $row["breweryDescription"], $row["breweryEstDate"], $row["breweryHours"], $row["breweryLocation"], $row["breweryName"], $row["breweryPhone"], $row["breweryUrl"]);
			}
		} catch(\Exception $exception) {
			// If the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($brewery);
	}


	/**
	 * Gets the brewery by breweryDbKey
	 *
	 * @param \Pdo $pdo PDO connection object
	 * @param string $breweryDbKey brewery breweryDB key used to identify the brewery
	 * @return Brewery|null returns either a brewery or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 *
	 **/

	public static function getBreweryByBreweryDbKey(\PDO $pdo, $breweryDbKey) {
		//sanitize the breweryDbKey before searching
		$breweryDbKey = trim($breweryDbKey);
		$breweryDbKey = filter_var($breweryDbKey, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if (empty($breweryDbKey) === true) {
			throw(new \PDOException("breweryDbKey is invalid"));
		}

		//create the query template
		$query = "SELECT breweryId, breweryDbKey, breweryDescription, breweryEstDate, breweryHours, breweryLocation, breweryName, breweryPhone, breweryUrl FROM brewery WHERE breweryDbKey = :breweryDbKey";
		$statement = $pdo->prepare($query);
		
		//bind the breweryDbKey to the placeholder in the template
		$parameters = array("breweryDbKey" => $breweryDbKey);
		$statement->execute($parameters);
		
		//grab the brewery from mySQL
		try {
			$brewery = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if ($row !== false) {
				$brewery = new Brewery($row["breweryId"], $row["breweryDbKey"],$row["breweryDescription"], $row["breweryEstDate"], $row["breweryHours"], $row["breweryLocation"], $row["breweryName"], $row["breweryPhone"], $row["breweryUrl"]);
			}
		} catch(\Exception $exception) {
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($brewery);
	}
	
	/** Gets the brewery by location
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param $breweryLocation location of brewery to search for
	 * @param \SplFixedArray of breweries found
	 * @return Brewery|null either brewery or null if not found
	 * @throws \PDOException when mySQL-related errors occur
	 **/
	public static function getBrewerybyBreweryLocation(\PDO $pdo, $breweryLocation) {
		// sanitize the brewery location before searching
		
		$breweryLocation = trim($breweryLocation);
		$breweryLocation = filter_var($breweryLocation, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($breweryLocation) === true) {
			throw (new \PDOException("Brewery location is invalid"));
		}
		// Create query template
		$query = "SELECT breweryId, breweryDbKey, breweryDescription, breweryEstDate, breweryHours, breweryLocation, breweryName, breweryPhone, breweryUrl FROM brewery WHERE breweryLocation LIKE :breweryLocation";
		$statement = $pdo->prepare($query);

		// Bind the placeholder in the template
		$breweryLocation = "%" . $breweryLocation . "%";
		$parameters = array("breweryLocation" => $breweryLocation);
		$statement->execute($parameters);

		// Grab the breweries from mySQL
		$breweries = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$brewery = new Brewery($row["breweryId"], $row["breweryDbKey"], $row["breweryDescription"], $row["breweryEstDate"], $row["breweryHours"], $row["breweryLocation"], $row["breweryName"], $row["breweryPhone"], $row["breweryUrl"]);
				$breweries[$breweries->key()] = $brewery;
				$breweries->next();
			} catch(\Exception $exception) {
				// If the row couldn't be converted, rethrow it
				throw (new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($breweries);
	}

	/**
	 * Gets the brewery by name
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param  $breweryName Name of brewery to search for
	 * @return \SplFixedArray of breweries found
	 * @throws \PDOException when mySQL-related errors occur
	 **/
	public static function getBreweryByBreweryName(\PDO $pdo, $breweryName) {
		// Sanitize the brewery name before searching
		$breweryName = trim($breweryName);
		$breweryName = filter_var($breweryName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($breweryName) === true) {
			throw(new \PDOException("Brewery name is invalid"));
		}
		//Create query template
		$query = "SELECT breweryId, breweryDbKey, breweryDescription, breweryEstDate, breweryHours, breweryLocation, breweryName, breweryPhone, breweryUrl FROM brewery WHERE breweryName LIKE :breweryName";
		$statement = $pdo->prepare($query);

		// Bind name to the placeholder in the template
		$breweryName = "%$breweryName%";
		$parameters = array("breweryName" => $breweryName);
		$statement->execute($parameters);

		// Grab the breweries from mySQL
		$breweries = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$brewery = new Brewery($row["breweryId"], $row["breweryDbKey"], $row["breweryDescription"], $row["breweryEstDate"], $row["breweryHours"], $row["breweryLocation"], $row["breweryName"], $row["breweryPhone"], $row["breweryUrl"]);
				$breweries[$breweries->key()] = $brewery;
				$breweries->next();
			} catch(\Exception $exception) {
				// If the row couldn't be converted, rethrow it
				throw (new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($breweries);
	}

	/**
	 * Gets all breweries
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray of breweries found
	 * @throws \PDOException when mySQL related errors occur
	 */
	public static function getAllBreweries(\PDO $pdo) {
		// Create query template
		$query = "SELECT breweryId, breweryDbKey, breweryDescription, breweryEstDate, breweryHours, breweryLocation, breweryName, breweryPhone, breweryUrl FROM brewery";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// Build an array of breweries
		$breweries = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$brewery = new Brewery($row["breweryId"], $row["breweryDbKey"], $row["breweryDescription"], $row["breweryEstDate"], $row["breweryHours"], $row["breweryLocation"], $row["breweryName"], $row["breweryPhone"], $row["breweryUrl"]);
				$breweries[$breweries->key()] = $brewery;
				$breweries->next();
			} catch(\Exception $exception) {
				// If the row couldn't be converted, rethrow it
				throw (new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($breweries);
	}

	/**
	 * Specify data which should be serialized to JSON
	 * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return mixed data which can be serialized by json_encode, which is a value of any type other than a resource.
	 * @since 5.4.0
	 */
	public function jsonSerialize() {
		return (get_object_vars($this));
	}
}