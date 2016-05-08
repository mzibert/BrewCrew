<?php
namespace Edu\Cnm\mzibert\BrewCrew\Test;

use Edu\Cnm\mzibert\BrewCrew\{Beer, beerBrewery};

//grab the project test parameters
require_once("BrewCrewTest.php");

//grab the class under scrutiny
require_once(dirname(__DIR__)."php/classes/autoload.php)");

/**
 * Full PHPUnit test for the Beer class
 *
 * This is a complete PHPUnit test of the Beer class.  It is complete because "ALL" mySQL/PDO enabled methods are tested for both invalid and valid inputs.
 *
 * @see Beer
 * @author Merri Zibert <mzibert@cnm.edu>
 **/
Class BeerTest extends BrewCrewTest {
	/**
	 * beer brewery of the Beer
	 * @var int $VALID_BEERBREWERYID
	 **/
	protected $VALID_BEERBREWERYID = "PHPUnit test passing";
	/**
	 * content of the updated beer brewery id
	 * @var int $VALID_BEERBREWERYID2
	 **/
	protected $VALID_BEERBREWERYID2 = "PHPUnit test still passing";
	/**
	 *beer brewery that created the beer; this is for foreign key relations
	 * @var BeerBreweryId beerBreweryId
	 **/
	protected $beerBreweryId = null;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		//run the default setUp() method first
		parent::setup();

		//create and insert a Brewery to own the test Beer
		$this->beerBreweryId = new BeerBreweryId (null, "@phpunit", "test@phpunit.de", "+12125551212");
		$this->beerBreweryId->insert($this->getPDO());
	}

	/**
	 * test inserting a valid beer and verify that the actual mySQL data matches
	 **/
	public function testInsertValidBeer() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("beer");

		//create a new Beer and insert it into mySQL
		$beer = new Beer(null, $this->beerBreweryId->getbeerBreweryId());
		$beer->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoBeer = Beer::getBeerbyBeerId($this->getPDO(), $beer->getBeerId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Beer"));
		$this->assertEquals($pdoBeer->getbeerBreweryId(), $this->beerbrewery->getBeerBreweryId());
	}

	/**
	 * Test inserting a beer that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidBeer() {
		//create a beer with a non null beer id and watch it fail
		$beer = new Beer(BrewCrewTest::INVALID_KEY, $this->beerBrewery->getBeerBreweryId());
		$beer->insert($this->getPDO());
	}

	/**
	 * test inserting a beer, editing it, and then updating it
	 **/
	public function testUpdateValidBeer() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("beer");

		//create a new beer and insert it into mySQL
		$beer = new Beer(null, $this->beerBrewery->getBeerBreweryId());
		$beer->insert($this->getPDO());

		//edit the beer and update it in mySQL ?????????????????????????
		//
		//
		//

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoBeer = Beer::getBeerByBeerId($this->getPDO(), $beer->getBeerId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("beer"));
		$this->asserEquals($pdoBeer->getBeerBreweryId(), $this->beerBrewery->getBeerBreweryId());
	}

	/**
	 * test updating a beer that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testUpdateInvalidBeer() {
		//create a Beer with a non null beer id and watch it fail
		$beer = new Beer(null, $this->beerBrewery->getBeerBreweryId());
		$beer->update($this->getPDO());
	}

	/**
	 *test creating a Beer and then deleting it
	 **/
	public function testDeleteValidBeer() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("beer");

		//create a new Beer and insert it into mySQL
		$beer = new Beer(null, $this->beerBrewery->getBeerBreweryId());
		$beer->insert($this->getPDO());

		//delete the beer from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("beer"));
		$beer->delete($this->getPDO());

		//grab the date from mySQL and enforce the Beer does not exist
		$pdoBeer = Beer::getBeerByBeerID($this->getPDO(), $beer->getBeerId());
		$this->asserNull($pdoBeer);
		$this->asserEquals($numRows, $this->getConnection()->getRowCount("beer"));
	}

	/**
	 * test deleting a Beer that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidBeer() {
		//create a Beer and try to delete it without actually inserting it
		$beer = new Beer(null, $this->beerBrewery->getBeerBreweryId());
		$beer->delete($this->getPDO());
	}

	/**
	 *test inserting a Beer and regrabbing it from mySQL
	 **/
	public function testGetValidBeerbyBeerId() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("beer");

		//create a new beer and insert it into mySQL
		$beer = new Beer(null, $this->beerBrewery->getBeerBreweryID());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoBeer = Beer::getBeerbyBeerId($this->getPDO(), $beer->getBeerId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("beer"));
		$this->assertEquals($pdoBeer->getBeerId(), $this->beer->getBeerId());
	}

	/**
	 * test grabbing a Beer that does not exist
	 **/
	public function testGetInvalidBeerByBeerId() {
		//grab a grab a beerBrewery id that exceeds the maximum allowable beerBrewery id
		$beer = Beer::getBeerByBeerId($this->getPDO(), BrewCrewTest::INVALID_KEY);
		$this->assertNull($beer);
	}
	/**
	 * test grabbing a Tweet by tweet content
	 * NEED HELP HERE (Top of Page 6)
	 **/

	/**
	 * test grabbing a tweet by content that does not exist
	 * NEED HELP HERE (bottom of page 6)
	 **/

	/**
	 * test grabbing all Beers
	 **/
	public function testGetAllValidBeers() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("beer");

		//create a new Beer and insert into mySQL
		$beer = new Beer(null, $this->beerBrewery->getBeerBreweryId());
		$beer->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Beer::getAllBeers($this->PDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("beer"));
		$thisassertCount(1, $results);
		$thisassertContainsOnlyInstancesOf("Edu\\Cnm\\mzibert\\BrewCrew\\Beer", $results);

		//grab the result from the array and validate it
		$pdoBeer = $results[0];
		$this->assertEquals($pdoBeer->get->beerBreweryID(), $this->beerBrewery->getBeerBreweryId());
	}
}
