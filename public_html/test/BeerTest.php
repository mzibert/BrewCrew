<?php
namespace Edu\Cnm\mzibert\BrewCrew\Test;

use Edu\Cnm\BrewCrew\{Beer, Brewery};

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
	public final function setUp(){
		//run the default setUp() method first
		parent::setup();

		//create and insert a Brewery to own the test Beer
		$this->beerBreweryId = new BeerBreweryId(null, "@phpunit", "test@phpunit.de", "+12125551212");
		$this->beerBreweryId->insert($this->getPDO());

		/**
		 * test inserting a valid beer and verify that the actual mySQL data matches
		 **/
		public function testInsertValidBeer(){
			//count the number of rows and save it for later
			$numRows = $this->getConnection()->getRowCount("beer");

			//create a new Beer and insert it into mySQL
			$beer = new
		}
	}

}
https://app.asana.com/0/117435667927162/118830311351349