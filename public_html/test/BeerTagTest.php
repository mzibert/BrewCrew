<?php
namespace Edu\Cnm\BrewCrew\Test;

use Edu\Cnm\BrewCrew\{
	Beer, BeerTag, Brewery, Tag
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
	 * Beer that the associated tags refer to
	 * @var Beer beer
	 **/
	protected $beer = null;

	/**
	 * BeerTag that associates the beer with the tag
	 * @var BeerTag beerTag
	 **/
	protected $beerTag = null;

	/**
	 * Brewery that made the beer being tagged
	 * @var Brewery brewery
	 **/
	protected $brewery = null;

	/**
	 * Tag that is linked to the beer
	 * @var Tag tag
	 *
	 **/
	protected $tag = null;

	/**
	 * Create dependent objects for each foreign key before running the test
	 **/
	public final function setUp() {
		//run the default setUp method first
		parent::setUp();

		//create and insert a beer that is being tagged
		$this->beer = new Beer(null, $this->brewery->getBreweryId, 10.5, "available whenever we like it to be", "lots of awards we don't care to name", .5, "something something about the taste.", "50", "Teh Awesome Beer", "Lager");
		$this->beer->insert($this->getPDO());

		//create and insert a brewery to own the tagged beer
		$this->brewery = new Brewery(null, "Describe this test brewery in full", "2010", "24/7/365 unless its raining, then we are closed", "transylvania", "Nerdfighteria", "5057771212", "test@phpunit.de");
		$this->brewery->insert($this->getPDO());

		//create a tag to be linked with the beer
		$this->tag = new Tag(null, "fruity");
		$this->tag->insert($this->getPDO());
	}

	/**
	 * Test inserting a valid reviewTag and verifying that the mySQL data matches
	 **/
	public function testInsertValidBeerTag() {
		//count the number of rows and save it for later
		$numrows = $this->getConnection()->getRowCount("beerTag");

		//create a new beerTag and insert into mySQL
		$beerTag = new BeerTag($this->beer->getBeerId(), $this->tag->getTagID());
		$beerTag->insert($this->getPDO());

		//grab the data from mySQL and enforce that the fields match our expectations
		$pdoBeerTag = BeerTag::getBeerTagByBeerId($this->getPDO(), $beerTag->getBeerTagBeerId());
		$this->assertequals($numrows + 1, $this->getConnection()->getRowCount("beerTag"));
		$this->assertequals($pdoBeerTag->getBeerTagBeerId(), $this->beer->getBeerId());
		$this->assertequals($pdoBeerTag->getBeerTagTagId(), $this->tag->getTagId());
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
	 * tests updating a beer that already exists
	 **/
	public function testUpdateInvalidBeerTag(){
		//create a beer tag with a non null id and watch it fail
		$beertag = new BeerTag($this->beer->getBeerId(), $this->tag->getTagId());
		$beertag->update($this->getPDO());
	}
	/**
	 * test that creates a beerTag and then deletes it
	 **/
	
	public function testDeleteValidBeerTag(){
		//count the numbet of rows and save it for later
		$numRows = $this->getconnection()->getRowCount("beerTag");
		
		//create a new beerTag and insert into mySQL
		$beerTag = new BeerTag($this->beer->getBeerId(), $this->tag->getTagId());
		$beerTag->insert($this->getPDO());
		
		//delete the beerTag from mySQL
		$this->assertequals($numRows + 1, $this->getConnection()->getRowCount("beerTag"));
		$beerTag->delete($this->getPDO());

		//grab the data from mySQL and verify that it doesn't exist
		$pdoBeerTag = BeerTag::getBeerTagByBeerId($this->getPDO(), $beerTag->getBeerTagByBeerId());
		$this->assertNull($pdoBeerTag);
		$this->assertequals($numRows, $this->getConnection()->getRowCount("beerTag"));
	}

	/**
	 * test deleting a beerTag that doesn't exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidBeerTag(){
		//create a beerTag and try deleting it without actually inserting it
		$beerTag = new BeerTag($this->beer->getBeerId(), $this->tag->getTagId());
		$beerTag->insert($this->getPDO());
	}

	/**
	 *testing get beerTag by valid beer id
	 **/
	public function getValidBeerTagByBeerTagBeerId() {
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
	public function getBeerTagByInvalidBeerTagBeerId(){
		//grab a review id that exceeds maximum allowed
		$beerTag = BeerTag::getBeerTagByBeerId($this->getPDO(), BrewCrewTest::INVALID_KEY);
		$this->assertNull($beerTag);
	}

	/**
	 *testing get beerTag by valid tag id
	 **/
	public function getValidBeerTagByBeerTagTagId(){
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

	public function getBeerTagByInvalidBeerTagTagId(){

		//grab a tag id that exceeds maximum allowed
		$beerTag = BeerTag::getBeerTagByTagId($this->getPDO(), BrewCrewTest::INVALID_KEY);
		$this->assertNull($beerTag);
	}

	/**
	 *test get beerTag by valid beer id, tag id
	 **/

	public function getValidBeerTagByBeerIdAndTagId(){
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
	public function getBeerTagByBothIds() {

		//grab a review id that exceeds maximum allowed
		$beerTag = BeerTag::getBeerTagByBeerIdAndTagId($this->getPDO(), BrewCrewTest::INVALID_KEY);
		$this->assertNull($beerTag);
	}
}