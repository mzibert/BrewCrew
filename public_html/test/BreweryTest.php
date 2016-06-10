<?php
namespace Edu\Cnm\BrewCrew\Test;
// grab the project test parameters
use Edu\Cnm\BrewCrew\Brewery;

require_once ("BrewCrewTest.php");

// Grab the class being tested
require_once (dirname(__DIR__) . "/php/classes/autoload.php");

/**
 * Full PHPUnit test for brewery class
 *
 * This is a complete PHPUnit test of the brewery class. It is complete because "ALL" mySQL/PDO enabled methods are tested for both invalid and valid inputs.
 *
 * @see \Edu\Cnm\BrewCrew\Brewery
 * @author Kate McGaughey therealmcgaughey@gmail.com
 *
 */

class BreweryTest extends BrewCrewTest {
	/**
	 * Content generated for description text
	 * @var string $VALID_BREWERY_DESCRIPTION
	 */
	protected $VALID_BREWERY_DESCRIPTION = "PHPUnit test passing";

	/**
	 * Content generated for description text
	 * @var string $VALID_BREWERY_DBKEY
	 */
	protected $VALID_BREWERY_DBKEY = "KR4X6i";

	/**
	 * Updated content for description text
	 * @var string $VALID_BREWERYEST_DESCRIPTION2
	 */
	protected $VALID_BREWERY_DESCRIPTION2 = "PHPUnit test still passing";

	/**
	 * Valid est date of a brewery
	 * @var string $VALID_BREWERY_EST_DATE
	 */
	protected $VALID_BREWERY_EST_DATE = "1985";

	/**
	 * Valid hours of a brewery
	 * @var string $VALID_BREWERY_HOURS
	 */
	protected $VALID_BREWERY_HOURS = "noon to midnight";

	/**
	 * Valid address of a brewery
	 * @var string $VALID_BREWERYLOCATION
	 */
	protected $VALID_BREWERY_LOCATION = "'Murica";

	/**
	 * Valid name to use
	 * @var string $VALID_BREWERYNAME
	 */
	protected $VALID_BREWERY_NAME = "Deep Dive";

	/**
	 * Second valid name to use
	 * @var string $VALID_BREWERYNAME2
	 */
	protected $VALID_BREWERY_NAME2 = "Deep Dive 2";

	/**
	 * phone number associated with the brewery
	 * @var string $VALID_BREWERYPHONE
	 */
	protected $VALID_BREWERY_PHONE = "773-509-5096";

	/**
	 * website of the brewery
	 * @var string $VALID_BREWERYURL
	 */
	protected $VALID_BREWERY_URL = "Some website";

	/**
	 * Test that inserts a valid brewery and then verifies that the mySQL data matches
	 */
	public function testInsertValidBrewery() {
		// Count the number of rows and save this for later
		$numRows = $this->getConnection()->getRowCount("brewery");

		// Create a new brewery and insert it into mySQL
		$brewery = new Brewery(null, $this->VALID_BREWERY_DESCRIPTION, $this->VALID_BREWERY_EST_DATE, $this->VALID_BREWERY_HOURS, $this->VALID_BREWERY_LOCATION, $this->VALID_BREWERY_NAME, $this->VALID_BREWERY_PHONE, $this->VALID_BREWERY_URL);
		$brewery->insert($this->getPDO());

		// Grab the data from mySQL and check the fields against our expectations
		// Looked at Skyler's work for help
		// @Link https://github.com/Skylarity/trufork/blob/master/public_html/test/restaurant-test.php
		$pdoBrewery = Brewery::getBreweryByBreweryId($this->getPDO(), $brewery->getBreweryId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("brewery"));
		$this->assertEquals($pdoBrewery->getBreweryDescription(), $this->VALID_BREWERY_DESCRIPTION);
		$this->assertEquals($pdoBrewery->getBreweryEstDate(), $this->VALID_BREWERY_EST_DATE);
		$this->assertEquals($pdoBrewery->getBreweryLocation(), $this->VALID_BREWERY_LOCATION);
		$this->assertEquals($pdoBrewery->getBreweryName(), $this->VALID_BREWERY_NAME);
		$this->assertEquals($pdoBrewery->getBreweryPhone(), $this->VALID_BREWERY_PHONE);
		$this->assertEquals($pdoBrewery->getBreweryUrl(), $this->VALID_BREWERY_URL);
	}

	/**
	 * Test inserting a brewery that already exists
	 *
	 * @expectedException \PDOException
	 */
	public function testInsertInvalidBrewery() {
		//create a brewery with a non null brewery id and watch it fail
		$brewery = new Brewery(BrewCrewTest::INVALID_KEY, $this->VALID_BREWERY_DESCRIPTION, $this->VALID_BREWERY_EST_DATE, $this->VALID_BREWERY_HOURS, $this->VALID_BREWERY_LOCATION, $this->VALID_BREWERY_NAME, $this->VALID_BREWERY_PHONE, $this->VALID_BREWERY_URL);
		$brewery->insert($this->getPDO());
	}

	/**
	 * Test inserting a brewery, editing it, and then updating it
	 */
	public function testUpdateValidBrewery() {
		// Count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("brewery");

		// Create a new brewery and insert it into mySQL
		$brewery = new Brewery(null, $this->VALID_BREWERY_DESCRIPTION, $this->VALID_BREWERY_EST_DATE, $this->VALID_BREWERY_HOURS, $this->VALID_BREWERY_LOCATION, $this->VALID_BREWERY_NAME, $this->VALID_BREWERY_PHONE, $this->VALID_BREWERY_URL);
		$brewery->insert($this->getPDO());

		// Edit the brewery and update it in mySQL
		$brewery->setBreweryName($this->VALID_BREWERY_NAME2);
		$brewery->update($this->getPDO());

		// Grab the data from mySQL and enforce the fields match our expectations
		// Looked at Skyler's work to figure out how this might be done
		// @Link https://github.com/Skylarity/trufork/blob/master/public_html/test/restaurant-test.php
		$pdoBrewery = Brewery::getBreweryByBreweryId($this->getPDO(), $brewery->getBreweryId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("brewery"));
		$this->assertEquals($pdoBrewery->getBreweryDescription(), $this->VALID_BREWERY_DESCRIPTION);
		$this->assertEquals($pdoBrewery->getBreweryEstDate(), $this->VALID_BREWERY_EST_DATE);
		$this->assertEquals($pdoBrewery->getBreweryLocation(), $this->VALID_BREWERY_LOCATION);
		$this->assertEquals($pdoBrewery->getBreweryName(), $this->VALID_BREWERY_NAME2);
		$this->assertEquals($pdoBrewery->getBreweryPhone(), $this->VALID_BREWERY_PHONE);
		$this->assertEquals($pdoBrewery->getBreweryUrl(), $this->VALID_BREWERY_URL);
	}

	/**
	 * Test updating a Brewery that does not exist
	 *
	 * @expectedException PDOException
	 * Again copying Skyler's work because I have no idea what this is
	 */
	public function testUpdateInvalidBrewery() {
		// Create a brewery and try to update it without actually inserting it
		$brewery = new Brewery(null, $this->VALID_BREWERY_DESCRIPTION, $this->VALID_BREWERY_EST_DATE, $this->VALID_BREWERY_HOURS, $this->VALID_BREWERY_LOCATION, $this->VALID_BREWERY_NAME, $this->VALID_BREWERY_PHONE, $this->VALID_BREWERY_URL);
		$brewery->update($this->getPDO());
	}

	/**
	 * Test creating a brewery and then deleting it
	 */
	public function testDeleteValidBrewery() {
		// Count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("brewery");

		// Create a new brewery and insert it into mySQL
		$brewery = new Brewery(null, $this->VALID_BREWERY_DESCRIPTION, $this->VALID_BREWERY_EST_DATE, $this->VALID_BREWERY_HOURS, $this->VALID_BREWERY_LOCATION, $this->VALID_BREWERY_NAME, $this->VALID_BREWERY_PHONE, $this->VALID_BREWERY_URL);
		$brewery->insert($this->getPDO());

		// Delete the brewery from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("brewery"));
		$brewery->delete($this->getPDO());

		// Grab the data from MySQL and enforce the brewery does not exist
		$pdoBrewery = Brewery::getBreweryByBreweryId($this->getPDO(), $brewery->getBreweryId());
		$this->assertNull($pdoBrewery);
		$this->assertSame($numRows, $this->getConnection()->getRowCount("brewery"));
	}

	/**
	 * Test deleting a brewery that doesn't exist
	 *
	 * @expectedException \PDOException
	 */
	public function testDeleteInvalidBrewery() {
		// Create a brewery and then try to delete it without inserting it into mySQL
		$brewery = new Brewery(null, $this->VALID_BREWERY_DESCRIPTION, $this->VALID_BREWERY_EST_DATE, $this->VALID_BREWERY_HOURS, $this->VALID_BREWERY_LOCATION, $this->VALID_BREWERY_NAME, $this->VALID_BREWERY_PHONE, $this->VALID_BREWERY_URL);
		$brewery->delete($this->getPDO());
	}

	/**
	 * Test getting brewery by valid brewery id
	 */
	public function testGetBrewerybyValidBreweryId() {
		// Count the number of rows and save this for later
		$numRows = $this->getConnection()->getRowCount("brewery");

		// Create a new brewery and insert it into mySQL
		$brewery = new Brewery(null, $this->VALID_BREWERY_DESCRIPTION, $this->VALID_BREWERY_EST_DATE, $this->VALID_BREWERY_HOURS, $this->VALID_BREWERY_LOCATION, $this->VALID_BREWERY_NAME, $this->VALID_BREWERY_PHONE, $this->VALID_BREWERY_URL);
		$brewery->insert($this->getPDO());

		// Grab the data from mySQL and check the fields against our expectations
		$pdoBrewery = Brewery::getBreweryByBreweryId($this->getPDO(), $brewery->getBreweryId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("brewery"));
		$this->assertLessThan($pdoBrewery->getBreweryId(), 0);
		$this->assertEquals($pdoBrewery->getBreweryDescription(), $this->VALID_BREWERY_DESCRIPTION);
		$this->assertEquals($pdoBrewery->getBreweryEstDate(), $this->VALID_BREWERY_EST_DATE);
		$this->assertEquals($pdoBrewery->getBreweryLocation(), $this->VALID_BREWERY_LOCATION);
		$this->assertEquals($pdoBrewery->getBreweryName(), $this->VALID_BREWERY_NAME);
		$this->assertEquals($pdoBrewery->getBreweryPhone(), $this->VALID_BREWERY_PHONE);
		$this->assertEquals($pdoBrewery->getBreweryUrl(), $this->VALID_BREWERY_URL);
	}

	/**
	 * Test getting brewery by invalid brewery id
	 */
	public function testGetBreweryByInvalidBreweryId() {
		// Grab a brewery by invalid key
		$brewery = Brewery::getBreweryByBreweryId($this->getPDO(), BrewCrewTest::INVALID_KEY);
		$this->assertNull($brewery);
	}

	/**
	 * Test getting brewery by valid BreweryDB primary key (their breweryId)
	 */
	public function testGetBrewerybyBreweryDbKey() {
		// Count the number of rows and save this for later
		$numRows = $this->getConnection()->getRowCount("brewery");

		// Get a brewery and insert it into mySQL
		$brewery = new Brewery(null, null, $this->VALID_BREWERY_DESCRIPTION, $this->VALID_BREWERY_EST_DATE, $this->VALID_BREWERY_HOURS, $this->VALID_BREWERY_LOCATION, $this->VALID_BREWERY_NAME, $this->VALID_BREWERY_PHONE, $this->VALID_BREWERY_URL);
		$brewery->insert($this->getPDO());

		// Grab the data from mySQL and check the fields against our expectations
		$pdoBrewery = Brewery::getBreweryByBreweryDbKey($this->getPDO(), $brewery->getBreweryDbKey());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("brewery"));
		$this->assertLessThan($pdoBrewery->getBreweryId(), 0);
		$this->assertEquals($pdoBrewery->getBreweryDbKey(), 0);
		$this->assertEquals($pdoBrewery->getBreweryDescription(), $this->VALID_BREWERY_DESCRIPTION);
		$this->assertEquals($pdoBrewery->getBreweryEstDate(), $this->VALID_BREWERY_EST_DATE);
		$this->assertEquals($pdoBrewery->getBreweryLocation(), $this->VALID_BREWERY_LOCATION);
		$this->assertEquals($pdoBrewery->getBreweryName(), $this->VALID_BREWERY_NAME);
		$this->assertEquals($pdoBrewery->getBreweryPhone(), $this->VALID_BREWERY_PHONE);
		$this->assertEquals($pdoBrewery->getBreweryUrl(), $this->VALID_BREWERY_URL);
	}

	/**
	 * Test getting brewery by invalid BreweryDB primary key (their breweryId)
	 */
	public function testGetBreweryByInvalidBreweryDbKey() {
		// Grab a brewery by invalid key
		$brewery = Brewery::getBreweryByBreweryId($this->getPDO(), BrewCrewTest::INVALID_KEY);
		$this->assertNull($brewery);
	}

	/**
	 * Test getting brewery by location
	 */
	public function testGetBreweryByBreweryLocation() {
		// Count the number of rows and save this for later
		$numRows = $this->getConnection()->getRowCount("brewery");

		// Create a new brewery and insert it into mySQL
		$brewery = new Brewery(null, $this->VALID_BREWERY_DESCRIPTION, $this->VALID_BREWERY_EST_DATE, $this->VALID_BREWERY_HOURS, $this->VALID_BREWERY_LOCATION, $this->VALID_BREWERY_NAME, $this->VALID_BREWERY_PHONE, $this->VALID_BREWERY_URL);
		$brewery->insert($this->getPDO());

		// Grab the data from mySQL and enforce the fields match our expectations
		$results = Brewery::getBrewerybyBreweryLocation($this->getPDO(), $brewery->getBreweryLocation());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("brewery"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Brewcrew\\Brewery", $results);

		// Grab the result from the array and validate it
		$pdoBrewery = $results[0];
		$this->assertEquals($pdoBrewery->getBreweryDescription(), $this->VALID_BREWERY_DESCRIPTION);
		$this->assertEquals($pdoBrewery->getBreweryEstDate(), $this->VALID_BREWERY_EST_DATE);
		$this->assertEquals($pdoBrewery->getBreweryLocation(), $this->VALID_BREWERY_LOCATION);
		$this->assertEquals($pdoBrewery->getBreweryName(), $this->VALID_BREWERY_NAME);
		$this->assertEquals($pdoBrewery->getBreweryPhone(), $this->VALID_BREWERY_PHONE);
		$this->assertEquals($pdoBrewery->getBreweryUrl(), $this->VALID_BREWERY_URL);
	}

	/**
	 * Test getting brewery by location that does not exist
	 */
	public function testGetInvalidBreweryByBreweryLocation() {
		// Grab a brewery by searching for a brewery that does not exist
		$brewery = Brewery::getBrewerybyBreweryLocation($this->getPDO(), "Mars");
		$this->assertCount(0, $brewery);
	}

	/**
	 * Test getting brewery by name
	 */
	public function testGetBreweryByBreweryName() {
		// Count the number of rows and save this for later
		$numRows = $this->getConnection()->getRowCount("brewery");

		// Create a new brewery and insert it into mySQL
		$brewery = new Brewery(null, $this->VALID_BREWERY_DESCRIPTION, $this->VALID_BREWERY_EST_DATE, $this->VALID_BREWERY_HOURS, $this->VALID_BREWERY_LOCATION, $this->VALID_BREWERY_NAME, $this->VALID_BREWERY_PHONE, $this->VALID_BREWERY_URL);
		$brewery->insert($this->getPDO());

		// Grab the data from mySQL and enforce the fields match our expectations
		$results = Brewery::getBreweryByBreweryName($this->getPDO(), $brewery->getBreweryName());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("brewery"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Brewcrew\\Brewery", $results);

		// Grab the result from the array and validate it
		$pdoBrewery = $results[0];
		$this->assertEquals($pdoBrewery->getBreweryDescription(), $this->VALID_BREWERY_DESCRIPTION);
		$this->assertEquals($pdoBrewery->getBreweryEstDate(), $this->VALID_BREWERY_EST_DATE);
		$this->assertEquals($pdoBrewery->getBreweryLocation(), $this->VALID_BREWERY_LOCATION);
		$this->assertEquals($pdoBrewery->getBreweryName(), $this->VALID_BREWERY_NAME);
		$this->assertEquals($pdoBrewery->getBreweryPhone(), $this->VALID_BREWERY_PHONE);
		$this->assertEquals($pdoBrewery->getBreweryUrl(), $this->VALID_BREWERY_URL);
	}

	/**
	 * Test getting brewery by name that does not exist
	 */
	public function testGetInvalidBreweryByBreweryName() {
		// Grab a brewery by searching for a brewery that does not exist
		$brewery = Brewery::getBrewerybyBreweryName($this->getPDO(), "WTF name");
		$this->assertCount(0, $brewery);
	}


	/**
	 * Test getting all breweries
	 */
	public function testGetAllValidBreweries() {
		// Count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("brewery");

		// Create a new brewery and insert to into mySQL
		$brewery = new Brewery(null, $this->VALID_BREWERY_DESCRIPTION, $this->VALID_BREWERY_EST_DATE, $this->VALID_BREWERY_HOURS, $this->VALID_BREWERY_LOCATION, $this->VALID_BREWERY_NAME, $this->VALID_BREWERY_PHONE, $this->VALID_BREWERY_URL);
		$brewery->insert($this->getPDO());

		// Grab the data from mySQL and enforce the fields match our expectations
		$results = Brewery::getAllBreweries($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("brewery"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Brewcrew\\Brewery", $results);

		// Grab the result from the array and validate it
		$pdoBrewery = $results[0];
		$this->assertEquals($pdoBrewery->getBreweryDescription(), $this->VALID_BREWERY_DESCRIPTION);
		$this->assertEquals($pdoBrewery->getBreweryEstDate(), $this->VALID_BREWERY_EST_DATE);
		$this->assertEquals($pdoBrewery->getBreweryLocation(), $this->VALID_BREWERY_LOCATION);
		$this->assertEquals($pdoBrewery->getBreweryName(), $this->VALID_BREWERY_NAME);
		$this->assertEquals($pdoBrewery->getBreweryPhone(), $this->VALID_BREWERY_PHONE);
		$this->assertEquals($pdoBrewery->getBreweryUrl(), $this->VALID_BREWERY_URL);
	}
}