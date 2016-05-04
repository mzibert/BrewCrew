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
	 * date or year brewery was established
	 * @var int $breweryEstDate
	 */
	private $breweryEstDate;

	/**
	 * brewery hours
	 * @var int $breweryHours
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
	 * @var int $breweryPhone
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
 * @param string $breweryDescription string containing description of the brewery
 * @param int $breweryEstDate date brewery was established
 * @param int $breweryHours brewery's hours
 * @param string $breweryLocation string containing brewery location
 * @param string $breweryName string containing brewery name
 * @param int $breweryPhone phone number of the brewery
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

}











