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
class BeerTagTest extends BrewCrewTest{

	
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
	public function testInsertValidBeerTag(){
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
	 * test inserting a reviewTag that already exists
	 * @expectedException PDOException
	 */
	 
}