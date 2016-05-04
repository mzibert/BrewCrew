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
	 * @var string $breweryId
	 */
	private $breweryId;

	/**
	 * description of the brewery
	 * @var string $breweryDescription
	 **/
	private $breweryDescription;

	/**
	 * date or year brewery was established
	 * @var string $breweryEstDate
	 */
	private $breweryEstDate;

	/**
	 * brewery hours
	 * @var string $breweryHours
	 */
	private $breweryHours;

	/**
	 * name of brewery
	 * @var string $breweryName
	 */
	private $breweryName;

	/**
	 * brewery address
	 * @var string $breweryLocation
	 */
	private $breweryLocation;

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