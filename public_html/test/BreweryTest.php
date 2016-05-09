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
	 * Valid ID to use; this starts as null and is assigned later
	 * @var int $VALID_BREWERYID
	 */
	protected $VALID_BREWERY_ID = null;

	/**
	 * Content generated for description text
	 * @var string $VALID_BREWERY_DESCRIPTION
	 */
	protected $VALID_BREWERY_DESCRIPTION = "PHPUnit test passing";

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
	 * Valid address of a brewery
	 * @var string $VALID_BREWERYLOCATION
	 */
	protected $VALID_BREWERY_LOCATION = "Some address";

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
	protected $VALID_BREWERY_PHONE = "Some phone number";

	/**
	 * website of the brewery
	 * @var string $VALID_BREWERYURL
	 */
	protected $VALID_BREWERY_URL = "Some website";

	/**
	 * No dependent objects in this class, right?
	 **/

	/**
	 * Test that inserts a valid brewery and then verifies that the mySQL data matches
	 */
	public function testInsertValidBrewery() {
		// Count the number of rows and save this for later
		$numRows  = $this->getConnection()->getRowCount("brewery");

		// Create a new brewery and insert it into mySQL
		$brewery = new Brewery(null, $this->VALID_BREWERY_ID, $this->VALID_BREWERY_DESCRIPTION, $this->VALID_BREWERY_EST_DATE, $this->VALID_BREWERY_LOCATION, $this->VALID_BREWERY_NAME, $this->VALID_BREWERY_PHONE, $this->VALID_BREWERY_URL);
		$brewery->insert($this->getPDO());

		// Grab the data from mySQL and check the fields against our expectations
		// Looked at Skyler's work to figure out how this might be done
		// @Link https://github.com/Skylarity/trufork/blob/master/public_html/test/restaurant-test.php
		$pdoBrewery = Brewery::getBreweryByBreweryId($this->getPDO(), $brewery->getBreweryId());
		$this->assertEquals($numRows +1, $this->getConnection()->getRowCount("brewery"));
		$this->assertLessThan($pdoBrewery->getBreweryId(), $this->getBreweryId(), 0);
		$this->assertEquals($pdoBeer->getBreweryId(), $this->VALID_BREWERY_ID);
		$this->assertEquals($pdoBeer->getBreweryDescription(), $this->VALID_BREWERY_DESCRIPTION);
		$this->assertEquals($pdoBeer->getBreweryEstDate(), $this->VALID_BREWERY_EST_DATE);
		$this->assertEquals($pdoBeer->getBreweryLocation(), $this->VALID_BREWERY_LOCATION);
		$this->assertEquals($pdoBeer->getBreweryName(), $this->VALID_BREWERY_NAME);
		$this->assertEquals($pdoBeer->getBreweryPhone(), $this->VALID_BREWERY_PHONE);
		$this->assertEquals($pdoBeer->getBreweryUrl(), $this->VALID_BREWERY_URL);
	}
	/**
	 * Test inserting a brewery that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidBrewery() {
		//create a brewery with a non null brewery id and watch it fail
		$brewery = new Brewery(BrewCrewTest::INVALID_KEY, $this->Brewery->getBreweryId());
		$brewery->insert($this->getPDO());
	}
	/**
	 * Test inserting a brewery, editing it, and then updating it
	 **/
	public function testUpdateValidBrewery() {
		// Count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("brewery");

		// Create a new brewery and insert it into mySQL
		$brewery = new Brewery(null, $this->VALID_BREWERY_ID, $this->VALID_BREWERY_DESCRIPTION, $this->VALID_BREWERY_EST_DATE, $this->VALID_BREWERY_LOCATION, $this->VALID_BREWERY_NAME, $this->VALID_BREWERY_PHONE, $this->VALID_BREWERY_URL);
		$brewery->insert($this->getPDO());

		// Edit the brewery and update it in mySQL
		$brewery->setName($this->VALID_NAME2);
		$brewery->update($this->getPDO());

		// Grab the data from mySQL and enforce the fields match our expectations
		// Looked at Skyler's work to figure out how this might be done
		// @Link https://github.com/Skylarity/trufork/blob/master/public_html/test/restaurant-test.php
		$pdoBeer = Beer::getBeerByBeerId($this->getPDO(), $brewery->getBeerId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("beer"));
		$this->assertLessThan($pdoBeer->getBrewery->getBreweryId(), 0);
		$this->assertEquals($pdoBeer->getBreweryId(), $this->VALID_BREWERY_ID);
		$this->assertEquals($pdoBeer->getBreweryDescription(), $this->VALID_BREWERY_DESCRIPTION);
		$this->assertEquals($pdoBeer->getBreweryEstDate(), $this->VALID_BREWERY_EST_DATE);
		$this->assertEquals($pdoBeer->getBreweryLocation(), $this->VALID_BREWERY_LOCATION);
		$this->assertEquals($pdoBeer->getBreweryName(), $this->VALID_BREWERY_NAME);
		$this->assertEquals($pdoBeer->getBreweryPhone(), $this->VALID_BREWERY_PHONE);
		$this->assertEquals($pdoBeer->getBreweryUrl(), $this->VALID_BREWERY_URL);
	}
	/** Test updating a Brewery that does not exist
	 *
	 * @expectedException PDOException
	 * Again copying Skyler's work because I have no idea what this is
	 * */
	public function testUpdateInvalidBrewery() {
		// Create a brewery and try to update it without actually inserting it
		$brewery = new Brewery(null, $this->VALID_BREWERY_ID, $this->VALID_BREWERY_DESCRIPTION, $this->VALID_BREWERY_EST_DATE, $this->VALID_BREWERY_LOCATION, $this->VALID_BREWERY_NAME, $this->VALID_BREWERY_PHONE, $this->VALID_BREWERY_URL);
		$brewery->update($this->getPDO());
	}
	/**
	 * Test creating a brewery and then deleting it
	 */
	public function testDeleteValidBrewery() {
		// Count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("brewery");

		// Create a new brewery and insert it into mySQL
		$brewery = new Brewery(null, $this->VALID_BREWERY_ID, $this->VALID_BREWERY_DESCRIPTION, $this->VALID_BREWERY_EST_DATE, $this->VALID_BREWERY_LOCATION, $this->VALID_BREWERY_NAME, $this->VALID_BREWERY_PHONE, $this->VALID_BREWERY_URL);
		$brewery->insert($this->getPDO());

		// Delete the brewery from mySQL
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("brewery"));
		$brewery->delete($this->getPDO());

		// Grab the data from MySQL and enforce the Restaurant does not exist
		$pdoBrewery = Brewery::getBreweryByBreweryId($this->getPDO(), $brewery->getBreweryId());
		$this->assertNull($pdoBrewery);
		$this->assertSame($numRows, $this->getConnection()->getRowCount("brewery"));
	}
}











































































