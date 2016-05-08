<?php
namespace Edu\Cnm\BrewCrew\Test;
// grab the project test parameters
use Edu\Cnm\kmcgaughey\brewcrew\Brewery;

require_once ("BrewCrewTest.php");

// grab the class being tested
require_once (dirname(__DIR__) . "../php/classes/autoload.php");

/**
 * Full PHPUnit test for brewery class
 *
 * This is a complete PHPUnit test of the brewery class.
 *
 * @see \Edu\Cnm\BREWCREW\Brewery
 * @author Kate McGaughey therealmcgaughey@gmail.com
 *
 */

class BreweryTest extends BrewCrewTest {
	/**
	 * description of the brewery
	 * @var string $VALID_BREWERYDESCRIPTION
	 */
	protected $VALID_BREWERYDESCRIPTION = "Some description";

	/**
	 * year brewery was established
	 * @var string $VALID_BREWERYESTDATE
	 */
	protected $VALID_BREWERYESTDATE = "1985";

	/**
	 * hours of the brewery
	 * @var string $VALID_BREWERYHOURS
	 */
	protected $VALID_BREWERY = "Some hours";

	/**
	 * address of the brewery
	 * @var string $VALID_BREWERYLOCATION
	 */
	protected $VALID_BREWERYLOCATION = "Some address";
	/**
	 * name of the brewery
	 * @var string $VALID_BREWERYNAME
	 */
	protected $VALID_BREWERYNAME = "Some brewery name";

	/**
	 * phone number associated with the brewery
	 * @var string $VALID_BREWERYPHONE
	 */
	protected $VALID_BREWERYPHONE = "Some phone number";

	/**
	 * website of the brewery
	 * @var string $VALID_BREWERYURL
	 */
	protected $VALID_BREWERYURL = "Some website";







	/**
	 * id of the brewery; this starts as null and is assigned later
	 * @var int $VALID_BREWERYID
	 */
	protected $VALID_BREWERYID = null;


	/**
	 * test that inserts a valid brewery and then verifies that the mySQL data matches
	 */
	public function testInsertValidBrewery() {
		// count the number of rows and save this for later
		$numRows  = $this->getConnection()->getRowCount("brewery");

		// create a new brewery and insert it into mySQL
		$brewery = new Brewery(null, $this->VALID_BREWERYDESCRIPTION, $this->VALID_BREWERYESTDATE, $this->VALID_BREWERYLOCATION, $this->VALID_BREWERYNAME, $this->VALID_BREWERYPHONE, $this->VALID_BREWERYURL);
		$brewery->insert($this->getPDO());

		// grab the data from mySQL and check the fields against our expectations
		$pdoBrewery = Brewery::getBreweryByBreweryId($this->getPDO(), $brewery->getBreweryId());
		$this->assertEquals($numRows +1, $this->getConnection()->getRowCount("brewery"));
		$this->assertEquals($pdoBrewery->//no idea102)
	}
}
















































