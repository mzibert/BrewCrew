<?php

namespace Edu\Cnm\kmcgaughey\brewcrew;
require_once("autoload.php");

/**
 * This class contains data and functionality for a brewery.
 *
 * @author Kate McGaughey therealmcgaughey@gmail.com
 */

class Brewery implements \JsonSerializable {
	use ValidateDate;

	/**
	 * ID for the brewery; this is the primary key
	 * @var int $breweryId
	 */
	private $breweryId;

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

}

/** Constructor for this Brewery
 *
 * @param int|null $newBreweryId id of this brewery or null if a new brewery
 * @param string $breweryDescription string of open text taken from the API used to describe the brewery
 * @param |Year $breweryEstDate date brewery was established
 * @param string $breweryHours an array of brewery's hours
 * @param string $breweryLocation string containing brewery location
 * @param string $breweryName string containing brewery name
 * @param string $breweryPhone phone number of the brewery
 * @param string $breweryUrl string containing website of the brewery
 * @throws \InvalidArgumentException if data types are not valid
 * @throws \RangeException if data values are out of bounds
 * @throws \TypeError if data types violate type hints
 * @throws \Exception if some other exception occurs
 */

public function __construct($breweryId, $breweryDescription, $breweryEstDate, $breweryHours, $breweryLocation, $breweryName, $breweryPhone, $breweryUrl) {
	try {
		$this->setBreweryId($breweryId);
		$this->setBreweryDescription($breweryDescription);
		$this->setBreweryEstDate($breweryEstDate);
		$this->setBreweryHours($breweryHours);
		$this->setBreweryLocation($breweryLocation);
		$this->setBreweryName($breweryName);
		$this->setBreweryPhone($breweryPhone);
		$this->setBreweryUrl($breweryUrl);
	}  catch(InvalidArgumentException $invalidArgument) {
			// Rethrow exception to the caller
			throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		catch(RangeException $range) {
			// Rethrow exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		catch(\Exception $exception)	{
			// Rethrow exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
			}
		}
	}
/** Accessor method for breweryId
 *
 * @return int|null value of Brewery id
 **/

	public function getBreweryId () {
		return ($this->userId);
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
			return
		}
		//verify the brewery id is positive
		if($newBreweryId <=0) {
			throw (new \RangeException("brewery id is not positive"));
		}
		//convert and store the brewery id
		$this->breweryId = $newBreweryId;
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
		if(strlen($newBreweryDescription) > 1000) {
			throw (new \RangeException("brewery description is greater than 1000 characters"));
		}
		//store the brewery description content
		$this->breweryDescription = $newBreweryDescription;
	}
/** Accessor method for breweryEstDate
 *
 * @return NO FUCKING CLUE year brewery was established
 **/
	public function getBreweryEstDate() {
		return($this->getBreweryEstDate);
	}

/** Mutator method for breweryEstDate
 *
 **/
	NO FUCKING CLUE
	
/** Accessor method for brewery hours
 *
 * @return string brewery hours 
 **/
	public function getBreweryHours() {
		return ($this->BreweryHours);
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
		$newBreweryHours = filter_var($newBreweryHours, FILTER_SANITIZE_STRING);
		if(empty($newBreweryHours) === true) {
			throw (new \InvalidArgumentException("brewery hours field is empty or insecure"));
		}
		if(strlen($newBreweryHours) > 250) {
			throw (new \RangeException("brewery hours field is greater than 250 characters"));
		}
		//store the brewery hours content
		$this->breweryHours = $newBreweryHours;
	}
	/** Accessor method for brewery location
	 *
	 * @return string brewery location
	 **/
	public function getBreweryLocation() {
		return ($this->BreweryLocation);
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
		$newBreweryLocation = filter_var($newBreweryLocation, FILTER_SANITIZE_STRING);
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
		return ($this->BreweryName);
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
		$newBreweryName = filter_var($newBreweryName, FILTER_SANITIZE_STRING);
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
		return ($this->BreweryPhone);
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
		$newBreweryPhone = filter_var($newBreweryPhone, FILTER_SANITIZE_STRING);
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
		return ($this->BreweryUrl);
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
		$newBreweryUrl = filter_var($newBreweryUrl, FILTER_SANITIZE_STRING);
		if(empty($newBreweryUrl) === true) {
			throw (new \InvalidArgumentException("brewery URL is empty or insecure"));
		}
		if(strlen($newBreweryUrl) > 250) {
			throw (new \RangeException("brewery URL field is greater than 250 characters"));
		}
		//store the brewery URL content
		$this->breweryUrl = $newBreweryUrl;
	}

}