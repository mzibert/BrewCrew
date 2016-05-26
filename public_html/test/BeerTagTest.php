<?php
namespace Edu\Cnm\BrewCrew\Test;

use Edu\Cnm\BrewCrew\{
	Brewery, User, Beer, Review, Tag, BeerTag
};

//Grab the project test parameters
require_once("BrewCrewTest.php");

//Grab the class that is being tested
require_once(dirname(__DIR__) . "/php/classes/autoload.php");

/**
 * Full php test of the class BeerTag
 * This is a full and complete PHPUnit test of the BeerTag class.  All mySQL/PDO enabled methods are tested for both valid and invalid inputs.
 *
 * @see \Edu\Cnm\BrewCrew\BeerTag
 *
 * @author Merri Zibert <mjzibert2@gmail.com>
 *
 **/
class BeerTagTest extends BrewCrewTest {

	/**
	 * Brewery that made the beer being tagged
	 * @var Brewery brewery
	 **/
	protected $BREWERY = null;
	/**
	 * user that will tag the beers
	 * @var User user
	 **/
	protected $USER = null;
	/**
	 * Valid ID to use; this starts as null and is assigned later
	 * @var Beer beer
	 **/
	protected $BEER = null;
	
	/**
	 * reviews that will use the beer tags
	 **/
	protected $REVIEW = null;
	
	/**
	 * Tag that is linked to the beer
	 * @var Tag tag
	 **/
	protected $TAG = null;
	
	/**
	 * Valid beertag
	 * @var BeerTag beerTag
	 **/
	protected $BEERTAG = null;
	
	/**
	 * review tag that will include the beer tag
	 **/
	protected $REVIEWTAG = null;

	/**
	 * Create dependent objects for each foreign key before running the test
	 **/
	public final function setUp() {
		//run the default setUp method first
		parent::setUp();

		//create and insert a brewery to own the tagged beer
		$this->brewery = new Brewery(null, "Describe this test brewery in full", "2010", "24/7/365 unless its raining, then we are closed", "transylvania", "Nerdfighteria", "5057771212", "test@phpunit.de");
		$this->brewery->insert($this->getPDO());

		//salt and hash generation
		$password = "hunter2";
		$salt = bin2hex(random_bytes(16));
		$hash = hash_pbkdf2("sha512", $password, $salt, 262144);
		
		//create and insert a user that uses the beer tag
		$this->user = new User(null, $this->brewery->getBreweryId(), 0, "token", '1980-01-01', "anon@test.com", "John", $hash, "Smith", $salt, "beerislife");
		$this->user->insert($this->getPDO());

		//create and insert a beer that is being tagged
		$this->beer = new Beer(null, $this->brewery->getBreweryId(), 4.2, "year-round", "Best of Albuquerque 2015", .5, "A nice, light, airy ale with a hint of orange", "so many IBU's its serverd with a spoon!", "Ivanna Beer", "Pale Ale");
		$this->beer->insert($this->getPDO());
		
		//create a review for the beer tag to be associated with
		$this->review = new Review (null, $this->beer->getBeerId(), $this->user->getUserId(), new \DateTime(), 5, "This is the best beer I have ever had!  I will definitely drink this again.");
		
		//create a tag to be linked with the beer
		$this->tag = new Tag(null, "fruity");
		$this->tag->insert($this->getPDO());
	}

	/**
	 * Test inserting a valid beerTag and verifying that the mySQL data matches
	 **/
	public function testInsertValidBeerTag() {
		//count the number of rows and save it for later
		$numrows = $this->getConnection()->getRowCount("beerTag");

		//create a new beerTag and insert into mySQL
		$beerTag = new BeerTag($this->beer->getBeerId(), $this->tag->getTagID());
		$beerTag->insert($this->getPDO());

		//grab the data from mySQL and enforce that the fields match our expectations
		$pdoBeerTag = BeerTag::getBeerTagByBeerId($this->getPDO(), $beerTag->getBeerTagBeerId());
		$this->assertEquals($numrows + 1, $this->getConnection()->getRowCount("beerTag"));
		$this->assertEquals($pdoBeerTag->getBeerTagBeerId(), $this->beer->getBeerId());
		$this->assertEquals($pdoBeerTag->getBeerTagTagId(), $this->tag->getTagId());
	}

	/**
	 * test inserting a beerTag that already exists
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidBeerTag() {
		//create a beer tag with a non null id and watch it fail
		$beerTag = new BeerTag(BrewCrewTest::INVALID_KEY, $this->tag->getTagId());
		$beerTag->insert($this->getPDO());
	}
	
	/**
	 * test that creates a beerTag and then deletes it
	 **/
	
	public function testDeleteValidBeerTag(){
		//count the numbet of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("beerTag");
		
		//create a new beerTag and insert into mySQL
		$beerTag = new BeerTag($this->beer->getBeerId(), $this->tag->getTagId());
		$beerTag->insert($this->getPDO());
		
		//delete the beerTag from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("beerTag"));
		$beerTag->delete($this->getPDO());

		//grab the data from mySQL and verify that it doesn't exist
		$pdoBeerTag = BeerTag::getBeerTagByBeerId($this->getPDO(), $beerTag->getBeerTagByBeerId());
		$this->assertNull($pdoBeerTag);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("beerTag"));
	}

	/**
	 * test deleting a beerTag that doesn't exist
	 *
	 **/
	public function testDeleteInvalidBeerTag(){
		//create a beerTag and try deleting it without actually inserting it
		$beerTag = new BeerTag($this->beer->getBeerId(), $this->tag->getTagId());
		$beerTag->delete($this->getPDO());
	}

	/**
	 *testing get beerTag by valid beer id
	 **/
	public function testGetValidBeerTagByBeerTagBeerId() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("beerTag");

		//create a new beerTag and insert it into mySQL
		$beerTag = new BeerTag($this->beer->getBeerId(), $this->tag->getTagId());
		$beerTag->insert($this->getPDO());

		//grab the data from mySQL and enforce that the fields match our expectations
		$results = BeerTag::getBeerTagByBeerId($this->getPDO(), $beerTag->getBeerTagBeerId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("beerTag"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf ("Edu\\Cnm\\BrewCrew\\BeerTag", $results);

		//grab the results from the array and validate them
		$pdoBeerTag = $results[0];
		$this->assertEquals($pdoBeerTag->getBeerTagBeerId(), $this->beer->getBeerId());
		$this->assertEquals($pdoBeerTag->getBeerTagTagId(), $this->tag->getTagId());
	}

	/**
	 * testing get beerTag by invalid beer id
	 **/
	public function testGetBeerTagByInvalidBeerTagBeerId(){
		//grab a review id that exceeds maximum allowed
		$beerTag = BeerTag::getBeerTagByBeerId($this->getPDO(), BrewCrewTest::INVALID_KEY);
		$this->assertNull($beerTag);
	}

	/**
	 *testing get beerTag by valid tag id
	 **/
	public function testGetValidBeerTagByBeerTagTagId(){
		//count the number of rows and save it for later
		$numRows=$this->getConnection()->getRowCount("beerTag");

		//create a new reviewTag and insert it into mySQL
		$beerTag = new BeerTag($this->beer->getBeerTag(), $this->tag->getTagId());
		$beerTag->insert($this->getPDO());

		//grab the data from mySQL and enforce that the fields match our expectations
		$results = BeerTag::getBeerTagByTagId($this->getPDO(), $beerTag->getBeerTagTagId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("beerTag"));
		$this->assertCout(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\BrewCrew\\BeerTag", $results);

		//grab the results from the array and validate them
		$pdoBeerTag = $results[0];
		$this->assertEquals($pdoBeerTag->getBeerTagBeerId(), $this->beer->getBeerId());
		$this->assertEquals($pdoBeerTag->getBeerTagTagId(), $this->tag->getTagId());
	}

	/**
	 * testing get beerTag by invalid tag id
	 **/

	public function testGetBeerTagByInvalidBeerTagTagId(){

		//grab a tag id that exceeds maximum allowed
		$beerTag = BeerTag::getBeerTagByTagId($this->getPDO(), BrewCrewTest::INVALID_KEY);
		$this->assertCount(0, $beerTag);
	}

	/**
	 *test get beerTag by valid beer id, tag id
	 **/

	public function testGetValidBeerTagByBeerIdAndTagId(){
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("beerTag");

		//create a new reviewTag and insert it into mySQL
		$beerTag = new BeerTag($this->beer->getBeerId(), $this->tag->getTagId());
		$beerTag->insert($this->getPDO());

		//grab the data from mySQL and enforce that the fields match our expectations
		$results = BeerTag::getBeerTagByBeerIdAndTagId($this->getPDO(), $beerTag->getBeerTagBeerId(), $beerTag->getBeerTagByTagId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("beerTag"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\BrewCrew\\BeerTag", $results);

		//grab the results from the array and validate them
		$pdoBeerTag = $results[0];
		$this->assertEquals($pdoBeerTag->getBeerTagBeerId(), $this->beer->getBeerId());
		$this->assertEquals($pdoBeerTag->getBeerTagTagId(), $this->tag->getTagId());
	}

	/**
	 * testing get beerTag by invalid beer id, tag id
	 **/
	public function testGetBeerTagByBothIds() {

		//grab a review id that exceeds maximum allowed
		$beerTag = BeerTag::getBeerTagByBeerIdAndTagId($this->getPDO(), BrewCrewTest::INVALID_KEY);
		$this->assertNull($beerTag);
	}
}