<?php
namespace Edu\Cnm\mzibert\BrewCrew\Test;

use Edu\Cnm\BrewCrew\{
	Beer, Brewery, Test\BrewCrewTest
};

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
Class BeerTest extends BrewCrewTest{
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
		public function testInsertValidBeer(){
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
	public function testInsertInvalidBeer(){
		//create a beer with a non null beer id and watch it fail
		$beer = new Beer(BrewCrewTest::INVALID_KEY, $this->beerBrewery->getBeerBreweryId());
		$beer->insert($this->getPDO());
	}
	/**
	 * test inserting a beer, editing it, and then updating it
	 **/
	public function testUpdateValidBeer(){
		//count the number of rows and save it for later
		$numRows=$this->getConnection()->getRowCount("beer");

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
	public function testUpdateInvalidBeer(){
		//create a Beer with a non null beer id and watch it fail
		$beer = new Beer(null, $this->beerBrewery->getBeerBreweryId());
		$beer->update($this->getPDO());
	}

	/**
	 *test creating a Beer and then deleting it
	 **/

}
