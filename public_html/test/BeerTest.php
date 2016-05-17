<?php
namespace Edu\Cnm\BrewCrew\Test;

use Edu\Cnm\BrewCrew\{Brewery, Beer};

//grab the project test parameters
require_once("BrewCrewTest.php");

//grab the class under scrutiny
require_once (dirname(__DIR__) . "/php/classes/autoload.php");

/**
 * Full PHPUnit test for the Beer class
 *
 * This is a complete PHPUnit test of the Beer class.  It is complete because "ALL" mySQL/PDO enabled methods are tested for both invalid and valid inputs.
 *
 * @see Beer
 * @author Merri Zibert <mzibert@cnm.edu>
 **/
class BeerTest extends BrewCrewTest {
	/**
	 * Valid ID to use; this starts as null and is assigned later
	 * @var int $VALID_BEERID
	 **/
	protected $VALID_BEERID = null;
	/**
	 * decimal generated for alcohol content by volume
	 * @var float $VALID_BEERABV
	 **/
	protected $VALID_BEERABV = 7.57;
	/**
	 * updated decimal of beer abv
	 * @var float $VALID_BEERABV2
	 **/
	protected $VALID_BEERABV2 = 2.00;
	/**
	 * the indication of when beer is available
	 * @var string $VALID_BEERAVAILABILITY
	 **/
	protected $VALID_BEERAVAILABILITY = "year round";
	/**
	 * all of the awards a beer has earned
	 * @var string $VALID_BEERAWARDS
	 **/
	protected $VALID_BEERAWARDS = "BEST of Albuquerque 2016";
	/**
	 * color of the beer
	 * @var float $VALID_BEERCOLOR
	 **/
	protected $VALID_BEERCOLOR = .75;
	/**
	 * Detailed description of the beer
	 * @var string $VALID_BEERDESCRIPTION
	 **/
	protected $VALID_BEERDESCRIPTION = "this beer is served mit hefe with a voluminous white head. The aroma is everything we love in the style; clove, banana and vanilla. The body is rich and creamy, yet finishes fairly dry and is as refreshing as any beer you’ll drink here or anywhere else.";
	/**
	 * the amount of ibu a beer contains
	 * @var string $VALID_BEERIBU
	 **/
	protected $VALID_BEERIBU = "classified";
	/**
	 * the amount of ibu a beer contains
	 * @var string $VALID_BEERIBU
	 **/
	protected $VALID_BEERIBU2 = "55";
	/**
	 * name of the beer
	 * @var string $VALID_BEERNAME
	 **/
	protected $VALID_BEERNAME = "Marzen Oktoberfest VMO #2";
	/**
	 * style of the beer
	 * @var string $VALID_BEERSTYLE
	 **/
	protected $VALID_BEERSTYLE = "malt";
	/**
	 *brewery that created the beer; this is for foreign key relations
	 * @var Brewery brewery
	 **/
	protected $brewery = null;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();

		//create and insert a Brewery to own the created Beer
		$this->brewery = new Brewery (null, "Describe this test brewery in full", "2010", "24/7/365 unless its raining, then we are closed", "transylvania", "Nerdfighteria", "5057771212", "test@phpunit.de");
		$this->brewery->insert($this->getPDO());
	}

	/**
	 * test inserting a valid beer and verify that the actual mySQL data matches
	 **/
	public function testInsertValidBeer() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("beer");

		//create a new Beer and insert it into mySQL
		$beer = new Beer(null, $this->brewery->getBreweryId(), $this->VALID_BEERABV, $this->VALID_BEERAVAILABILITY, $this->VALID_BEERAWARDS,  $this->VALID_BEERCOLOR, $this->VALID_BEERDESCRIPTION, $this->VALID_BEERIBU,$this->VALID_BEERNAME, $this->VALID_BEERSTYLE);

		//var_dump($this->brewery);

		$beer->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoBeer = Beer::getBeerbyBeerId($this->getPDO(), $beer->getBeerId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("beer"));
		$this->assertEquals($pdoBeer->getBeerBreweryId(), $this->brewery->getBreweryId());
		$this->assertEquals($pdoBeer->getBeerAbv(), $this->VALID_BEERABV);
		$this->assertEquals($pdoBeer->getBeerAvailability(), $this->VALID_BEERAVAILABILITY);
		$this->assertEquals($pdoBeer->getBeerAwards(), $this->VALID_BEERAWARDS);
		$this->assertEquals($pdoBeer->getBeerColor(), $this->VALID_BEERCOLOR);
		$this->assertEquals($pdoBeer->getBeerDescription(), $this->VALID_BEERDESCRIPTION);
		$this->assertEquals($pdoBeer->getBeerIbu(), $this->VALID_BEERIBU);
		$this->assertEquals($pdoBeer->getBeerName(), $this->VALID_BEERNAME);
		$this->assertEquals($pdoBeer->getBeerStyle(), $this->VALID_BEERSTYLE);
	}

	/**
	 * Test inserting a beer that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidBeer() {
		//create a beer with a non null primary key (beer id) and watch it fail
		$beer = new Beer(BrewCrewTest::INVALID_KEY, $this->brewery->getBreweryId(),
		$this->VALID_BEERABV, $this->VALID_BEERAVAILABILITY, $this->VALID_BEERAWARDS, $this->VALID_BEERCOLOR, $this->VALID_BEERDESCRIPTION, $this->VALID_BEERIBU, $this->VALID_BEERNAME, $this->VALID_BEERSTYLE);
		$beer->insert($this->getPDO());
	}

	/**
	 * test inserting a beer, editing it, and then updating it
	 **/
	public function testUpdateValidBeer() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("beer");

		//create a new beer and insert it into mySQL
		$beer = new Beer(null, $this->brewery->getBreweryId(),
			$this->VALID_BEERABV, $this->VALID_BEERAVAILABILITY, $this->VALID_BEERAWARDS, $this->VALID_BEERCOLOR, $this->VALID_BEERDESCRIPTION, $this->VALID_BEERIBU, $this->VALID_BEERNAME, $this->VALID_BEERSTYLE);
		$beer->insert($this->getPDO());

		//edit the beer and update it in mySQL
		$beer->setBeerAbv($this->VALID_BEERABV2);
		$beer->update($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoBeer = Beer::getBeerByBeerId($this->getPDO(), $beer->getBeerId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("beer"));
		$this->assertEquals($pdoBeer->getBeerBreweryId(), $this->brewery->getBreweryId());
		$this->assertEquals($pdoBeer->getBeerAbv(), $this->VALID_BEERABV);
		$this->assertEquals($pdoBeer->getBeerAvailability(), $this->VALID_AVAILABILITY);
		$this->assertEquals($pdoBeer->getBeerAwards(), $this->VALID_BEER_AWARDS);
		$this->assertEquals($pdoBeer->getBeerColor(), $this->VALID_BEERCOLOR);
		$this->assertEquals($pdoBeer->getBeerDescription(), $this->VALID_BEERDESCRIPTION);
		$this->assertEquals($pdoBeer->getBeerIbu(), $this->VALID_BEERIBU);
		$this->assertEquals($pdoBeer->getBeerName(), $this->VALID_BEERNAME);
		$this->assertEquals($pdoBeer->getBeerStyle(), $this->VALID_BEERSTYLE);
	}

	/**
	 * test updating a beer that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testUpdateInvalidBeer() {
		//create a Beer with a non null beer id and watch it fail
		$beer = new Beer(null, $this->brewery->getBreweryId(),
			$this->VALID_BEERABV, $this->VALID_BEERAVAILABILITY, $this->VALID_BEERAWARDS, $this->VALID_BEERCOLOR, $this->VALID_BEERDESCRIPTION, $this->VALID_BEERIBU, $this->VALID_BEERNAME, $this->VALID_BEERSTYLE);
		$beer->update($this->getPDO());
	}

	/**
	 *test creating a Beer and then deleting it
	 **/
	public function testDeleteValidBeer() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("beer");

		//create a new Beer and insert it into mySQL
		$beer = new Beer(null, $this->brewery->getBreweryId(),
			$this->VALID_BEERABV, $this->VALID_BEERAVAILABILITY, $this->VALID_BEERAWARDS, $this->VALID_BEERCOLOR, $this->VALID_BEERDESCRIPTION, $this->VALID_BEERIBU, $this->VALID_BEERNAME, $this->VALID_BEERSTYLE);
		$beer->insert($this->getPDO());

		//delete the beer from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("beer"));
		$beer->delete($this->getPDO());

		//grab the date from mySQL and enforce the Beer does not exist
		$pdoBeer = Beer::getBeerByBeerId($this->getPDO(), $beer->getBeerId());
		$this->assertNull($pdoBeer);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("beer"));
	}

	/**
	 * test deleting a Beer that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidBeer() {
		//create a Beer and try to delete it without actually inserting it
		$beer = new Beer(null, $this->brewery->getBreweryId(),
			$this->VALID_BEERABV, $this->VALID_BEERAVAILABILITY, $this->VALID_BEERAWARDS, $this->VALID_BEERCOLOR, $this->VALID_BEERDESCRIPTION, $this->VALID_BEERIBU, $this->VALID_BEERNAME, $this->VALID_BEERSTYLE);
		$beer->delete($this->getPDO());
	}

	/**
	 *test inserting a Beer and regrabbing it from mySQL
	 **/
	public function testGetValidBeerByBeerId() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("beer");

		//create a new beer and insert it into mySQL
		$beer = new Beer(null, $this->brewery->getBreweryId(), $this->VALID_BEERABV, $this->VALID_BEERAVAILABILITY, $this->VALID_BEERAWARDS, $this->VALID_BEERCOLOR, $this->VALID_BEERDESCRIPTION, $this->VALID_BEERIBU, $this->VALID_BEERNAME, $this->VALID_BEERSTYLE);
		$beer->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoBeer = Beer::getBeerByBeerId($this->getPDO(), $beer->getBeerId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("beer"));
		$this->assertEquals($pdoBeer->getBeerBreweryId(), $this->brewery->getBreweryId());
		$this->assertEquals($pdoBeer->getBeerAbv(), $this->VALID_BEERABV);
		$this->assertEquals($pdoBeer->getBeerAvailability(), $this->VALID_BEERAVAILABILITY);
		$this->assertEquals($pdoBeer->getBeerAwards(), $this->VALID_BEERAWARDS);
		$this->assertEquals($pdoBeer->getBeerColor(), $this->VALID_BEERCOLOR);
		$this->assertEquals($pdoBeer->getBeerDescription(), $this->VALID_BEERDESCRIPTION);
		$this->assertEquals($pdoBeer->getBeerIbu(), $this->VALID_BEERIBU);
		$this->assertEquals($pdoBeer->getBeerName(), $this->VALID_BEERNAME);
		$this->assertEquals($pdoBeer->getBeerStyle(), $this->VALID_BEERSTYLE);
	}
	/**
	 * test grabbing a Beer that does not exist
	 **/
	public function testGetInvalidBeerByBeerId() {
		//grab a beer id that exceeds the maximum allowable id limit
		$beer = Beer::getBeerByBeerId($this->getPDO(), BrewCrewTest::INVALID_KEY);
		$this->assertNull($beer);
	}
	/**
	 * test grabbing a beer by breweryId
	 **/
	public function testGetBeerByBreweryId(){
		//count the number of rows and save for later
		$numRows = $this->getConnection()->getRowCount("beer");

		//create a new beer and insert into mySQL
		$beer = new Beer(null, $this->brewery->getBreweryId(), $this->VALID_BEERABV, $this->VALID_BEERAVAILABILITY, $this->VALID_BEERAWARDS, $this->VALID_BEERCOLOR, $this->VALID_BEERDESCRIPTION, $this->VALID_BEERIBU, $this->VALID_BEERNAME, $this->VALID_BEERSTYLE);
		$beer->insert($this->getPDO());

		//grab the data from mySQL and check the fields against our expectations
		$results = Beer::getBeerByBreweryId($this->getPDO(), $beer->getBreweryId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("beer"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\BrewCrew\\Beer", $results);

		//grab the result from the resulting array and validate it
		$pdoBeer = $results[0];
		$this->assertEquals($pdoBeer->getBeerBreweryId(), $this->brewery->getBreweryId());
		$this->assertEquals($pdoBeer->getBeerAbv(), $this->VALID_BEERABV);
		$this->assertEquals($pdoBeer->getBeerAvailability(), $this->VALID_AVAILABILITY);
		$this->assertEquals($pdoBeer->getBeerAwards(), $this->VALID_BEER_AWARDS);
		$this->assertEquals($pdoBeer->getBeerColor(), $this->VALID_BEERCOLOR);
		$this->assertEquals($pdoBeer->getBeerDescription(), $this->VALID_BEERDESCRIPTION);
		$this->assertEquals($pdoBeer->getBeerIbu(), $this->VALID_BEERIBU);
		$this->assertEquals($pdoBeer->getBeerName(), $this->VALID_BEERNAME);
		$this->assertEquals($pdoBeer->getBeerStyle(), $this->VALID_BEERSTYLE);
	}

	/**
	 * test grabbing a beer by an invalid brewery id
	 **/
	public function testGetInvalidBeerByBreweryId(){
		//grab a brewery id that exceeds the maximum allowable id limit
		$beer = Beer::getBeerByBreweryId($this->getPDO(), BrewCrewTest::INVALID_KEY);
		$this->assertNull($beer);
	}
	/**
	 * test grabbing a beer by beer ibu
	 */
	public function testGetBeerByBeerIbu() {
		//count the number of rows and save this for later
		$numRows = $this->getConnection()->getRowCount("beer");

		//create a new beer and insert it into mySQL
		$beer = new Beer(null, $this->brewery->getBreweryId(), $this->VALID_BEERABV, $this->VALID_BEERAVAILABILITY, $this->VALID_BEERAWARDS,  $this->VALID_BEERCOLOR, $this->VALID_BEERDESCRIPTION, $this->VALID_BEERIBU, $this->VALID_BEERNAME, $this->VALID_BEERSTYLE);
		$beer->insert($this->getPDO());

		//grab the data from mySQL and check the fields against our expectations
		$results = Beer::getBeerByBeerIbu($this->getPDO(), $beer->getBeerIbu());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("beer"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\BrewCrew\\Beer", $results);

		//grab the result from the resulting array and validate it
		$pdoBeer = $results[0];
		$this->assertEquals($pdoBeer->getBeerBreweryId(), $this->brewery->getBreweryId());
		$this->assertEquals($pdoBeer->getBeerAbv(), $this->VALID_BEERABV);
		$this->assertEquals($pdoBeer->getBeerAvailability(), $this->VALID_BEERAVAILABILITY);
		$this->assertEquals($pdoBeer->getBeerAwards(), $this->VALID_BEERAWARDS);
		$this->assertEquals($pdoBeer->getBeerColor(), $this->VALID_BEERCOLOR);
		$this->assertEquals($pdoBeer->getBeerDescription(), $this->VALID_BEERDESCRIPTION);
		$this->assertEquals($pdoBeer->getBeerIbu(), $this->VALID_BEERIBU);
		$this->assertEquals($pdoBeer->getBeerName(), $this->VALID_BEERNAME);
		$this->assertEquals($pdoBeer->getBeerStyle(), $this->VALID_BEERSTYLE);
	}

	/**
	 * test grabbing a beer by beer Ibu that doesn't exist
	 */
	public function testGetInvalidBeerByBeerIbu() {
		//grab a beer by looking for beers with no applicable beer Ibu's
		$beer = Beer::getBeerByBeerIbu($this->getPDO(), "way to many ibus to even discuss the levels.  It truly is an outrageous amount and should only be served with a spoon");
		$this->assertCount(0, $beer);
	}

	/**
	 * test grabbing a beer by beer color
	 **/
	public function testGetBeerByBeerColor() {
		//count the number of rows and save this for later
		$numRows = $this->getConnection()->getRowCount("beer");

		//create a new beer and insert it into mySQL
		$beer = new Beer(null, $this->brewery->getBreweryId(), $this->VALID_BEERABV, $this->VALID_BEERAVAILABILITY, $this->VALID_BEERAWARDS, $this->VALID_BEERCOLOR, $this->VALID_BEERDESCRIPTION, $this->VALID_BEERIBU, $this->VALID_BEERNAME, $this->VALID_BEERSTYLE);
		$beer->insert($this->getPDO());

		//grab the data from mySQL and check the fields against our expectations
		$results = Beer::getBeerByBeerColor($this->getPDO(), $beer->getBeerColor());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("beer"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\BrewCrew\\Beer", $results);

		//grab the result from the resulting array and validate it
		$pdoBeer = $results[0];
		$this->assertEquals($pdoBeer->getBeerBreweryId(), $this->brewery->getBreweryId());
		$this->assertEquals($pdoBeer->getBeerAbv(), $this->VALID_BEERABV);
		$this->assertEquals($pdoBeer->getBeerAvailability(), $this->VALID_AVAILABILITY);
		$this->assertEquals($pdoBeer->getBeerAwards(), $this->VALID_BEER_AWARDS);
		$this->assertEquals($pdoBeer->getBeerColor(), $this->VALID_BEERCOLOR);
		$this->assertEquals($pdoBeer->getBeerDescription(), $this->VALID_BEERDESCRIPTION);
		$this->assertEquals($pdoBeer->getBeerIbu(), $this->VALID_BEERIBU);
		$this->assertEquals($pdoBeer->getBeerName(), $this->VALID_BEERNAME);
		$this->assertEquals($pdoBeer->getBeerStyle(), $this->VALID_BEERSTYLE);
	}
	/**
	 * test grabbing a beer by beer color that doesn't exist
	 */
	public function testGetInvalidBeerByBeerColor() {
		//grab a beer by looking for beers with no applicable beer color
		$beer = Beer::getBeerByBeerColor($this->getPDO(), "light amber");
		$this->assertCount(0, $beer);
	}
	/**
 * test grabbing a beer by beer style
 **/
	public function testGetBeerByBeerStyle() {
		//count the number of rows and save this for later
		$numRows = $this->getConnection()->getRowCount("beer");

		//create a new beer and insert it into mySQL
		$beer = new Beer(null, $this->brewery->getBreweryId(), $this->VALID_BEERABV, $this->VALID_BEERAVAILABILITY, $this->VALID_BEERAWARDS, $this->VALID_BEERCOLOR, $this->VALID_BEERDESCRIPTION, $this->VALID_BEERIBU, $this->VALID_BEERNAME, $this->VALID_BEERSTYLE);
		$beer->insert($this->getPDO());

		//grab the data from mySQL and check the fields against our expectations
		$results = Beer::getBeerByBeerStyle($this->getPDO(), $beer->getBeerStyle());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("beer"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\BrewCrew\\Beer", $results);

		//grab the result from the resulting array and validate it
		$pdoBeer = $results[0];
		$this->assertEquals($pdoBeer->getBeerBreweryId(), $this->brewery->getBreweryId());
		$this->assertEquals($pdoBeer->getBeerAbv(), $this->VALID_BEERABV);
		$this->assertEquals($pdoBeer->getBeerAvailability(), $this->VALID_BEERAVAILABILITY);
		$this->assertEquals($pdoBeer->getBeerAwards(), $this->VALID_BEERAWARDS);
		$this->assertEquals($pdoBeer->getBeerColor(), $this->VALID_BEERCOLOR);
		$this->assertEquals($pdoBeer->getBeerDescription(), $this->VALID_BEERDESCRIPTION);
		$this->assertEquals($pdoBeer->getBeerIbu(), $this->VALID_BEERIBU);
		$this->assertEquals($pdoBeer->getBeerName(), $this->VALID_BEERNAME);
		$this->assertEquals($pdoBeer->getBeerStyle(), $this->VALID_BEERSTYLE);
	}
	/**
	 * test grabbing a beer by beer style that doesn't exist
	 */
	public function testGetInvalidBeerByBeerStyle() {
		//grab a beer by looking for beers with no applicable beer style
		$beer = Beer::getBeerByBeerColor($this->getPDO(), "1212121212121212121212121212121212121212121212");
		$this->assertCount(0, $beer);
	}
}
