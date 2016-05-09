<?php
namespace Edu\Cnm\BrewCrew\Test;

use Edu\Cnm\BrewCrew\{
	Brewery, User, Beer, Review, Tag, ReviewTag
};

//grab the project test parameters
require_once("BrewCrewTest.php");

//grab the class under scrutiny--being tested
require_once(dirname(__DIR__) . "../php/classes/autoload.php");

/**
 * Full PHPUnit test for the review class
 *
 * This is a complete PHPUnit test of the ReviewTag class.  It is considered complete because *ALL* mySQL/PDO enabled methods are tested for both invalid, and for valid inputs.
 *
 * @see \Edu\Cnm\BrewCrew\ReviewTag
 * @author Alicia Broadhurst <abroadhurst@cnm.edu>
 */
class ReviewTagTest extends BrewCrewTest {

	/**
	 * Brewery associated with beer being reviewed
	 * @var Brewery brewery
	 */
	protected $brewery = null;

	/**
	 * Beer that is being reviewed; this is for foreign key relations
	 * @var Beer beer
	 */
	protected $beer = null;

	/**
	 * User that wrote the review; this is for foreign key relations
	 * @var User user
	 */
	protected $user = null;
	/**
	 * Review that contains the associated tags
	 * @var Review review
	 */
	protected $review = null;
	/**
	 * Tags that are linked to the review
	 * @var Tag tag
	 */
	protected $tag = null;

	/**
	 * Create dependent objects before running each test AKA foreign objects(keys)
	 */
	public final function setUp() {
		//run the default setUp method first
		parent::setUp();

		//create and insert a brewery to own the reviewed beer
		$this->brewery = new Brewery(null, "description of Test Brewery", "2005", "24/7 8 days a week", "The middle of nowhere", "Test Brewery", "1238675309", "www.awesometestbrewery.com");
		$this->brewery->insert($this->getPDO());

		//create and insert a beer that is being reviewed
		$this->beer = new Beer(null, $this->brewery->getBreweryId, 10.5, "available whenever we like it to be", "lots of awards we don't care to name", .5, "something something about the taste.", "50", "Teh Awesome Beer", "Lager");
		$this->beer->insert($this->getPDO());

		//create and insert a user that owns the review
		$this->user = new User(null, null, 0, "token", '1980-01-01', "anon@test.com", "John", "d3f5cd178c01bff44f6be00eb0d5d0a0cb3d5275a641fa11e41739ae1ed7c717d9c0cbf08912836d63715c1e5116df38b505c72f762a737a88d964e435dc78a1", "Smith", "cfad559b8d496bac9af4dbfc0bf5ebdd", "beerfan4lyfe");
		$this->user->insert($this->getPDO());

		//create a review for the tags to be associated with
		$this->review = new Review(null, $this->beer->getBeerId, $this->user->getUserId, new \DateTime(), 5, "this beer was really good. I liked it a lot.");
		$this->review->insert($this->getPDO());

		//create a tag to be linked to the review
		$this->tag = new Tag(null, "Hoppy");
		$this->tag->insert($this->getPDO());
	}

	//INSERT
	/**
	 * Test inserting a valid reviewTag and verifying that the mySQL data matches
	 */
	public function testInsertValidReviewTag() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("reviewTag");

		//create a new reviewTag and insert it into mySQL
		$reviewTag = new ReviewTag($this->review->getReviewId(), $this->tag->getTagId());
		$reviewTag->insert($this->getPDO());

		//grab the data from mySQL and enforce that the fields match our expectations
		$pdoReviewTag = ReviewTag::getReviewTagByReviewId($this->getPDO(), $reviewTag->getReviewTagReviewId());
		//QUESTION since this uses reviewId, do I need another insert test that uses tagId? would need to duplicate down the line
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("reviewTag"));
		$this->assertEquals($pdoReviewTag->getReviewTagReviewId(), $this->review->getReviewId());
		$this->assertEquals($pdoReviewTag->getReviewTagTagId(), $this->tag->getTagId());
	}

	/**
	 * test inserting a reviewTag that already exists
	 * @expectedException PDOException
	 */
	public function testInsertInvalidReviewTag() {
		//create a reviewTag with a non-null id and watch it fail
		$reviewTag = new ReviewTag(BrewCrewTest::INVALID_KEY, $this->tag->getTagId());
		$reviewTag->insert($this->getPDO());
	}

	//UPDATE
	/**
	 * test updating a review that already exists
	 */
	public function testUpdateInvalidReviewTag() {
		//create a reviewTag with a non-null id and watch it fail
		$reviewTag = new ReviewTag($this->review->getReviewId(), $this->tag->getTagId());
		$reviewTag->update($this->getPDO());
	}

	//DELETE
	/**
	 * test that creates a reviewTag and then deletes it
	 */
	public function testDeleteValidReviewTag() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("reviewTag");

		//create a new reviewTag and insert it into mySQL
		$reviewTag = new ReviewTag($this->review->getReviewId(), $this->tag->getTagId());
		$reviewTag->insert($this->getPDO());

		//delete the reviewTag from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("reviewTag"));
		$reviewTag->delete($this->getPDO());

		//grab the data from mySQL and verify that it doesn't exist
		$pdoReviewTag = ReviewTag::getReviewTagByReviewId($this->getPDO(), $reviewTag->getReviewTagReviewId());
		$this->assertNull($pdoReviewTag);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("reviewTag"));
	}

	/**
	 * test deleting a reviewTag that doesn't exist
	 *
	 * @expectedException PDOException
	 */
	public function testDeleteInvalidReviewTag() {
		//create a reviewTag and try to delete it without actually inserting it
		$reviewTag = new ReviewTag($this->review->getReviewId(), $this->tag->getTagId());
		$reviewTag->delete($this->getPDO());
	}

	//GET FOObyBARs
	/**
	 *testing get reviewTag by valid review id
	 */
	public function getValidReviewTagByReviewTagReviewId() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("reviewTag");

		//create a new reviewTag and insert it into mySQL
		$reviewTag = new ReviewTag($this->review->getReviewId(), $this->tag->getTagId());
		$reviewTag->insert($this->getPDO());

		//grab the data from mySQL and enforce that the fields match our expectations
		$results = ReviewTag::getReviewTagByReviewId($this->getPDO(), $reviewTag->getReviewTagReviewId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("reviewTag"));
		$this->assertCout(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\BrewCrew\\ReviewTag", $results);

		//grab the results from the array and validate them
		$pdoReviewTag = $results[0];
		$this->assertEquals($pdoReviewTag->getReviewTagReviewId(), $this->review->getReviewId());
		$this->assertEquals($pdoReviewTag->getReviewTagTagId(), $this->tag->getTagId());

	}

	/**
	 * testing get reviewTag by invalid review id
	 */
	public function getReviewTagByInvalidReviewTagReviewId() {

		//grab a review id that exceeds maximum allowed
		$reviewTag = ReviewTag::getReviewTagByReviewId($this->getPDO(), BrewCrewTest::INVALID_KEY);
		$this->assertNull($reviewTag);
	}


	/**
	 *testing get reviewTag by valid tag id
	 */
	public function getValidReviewTagByReviewTagTagId() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("reviewTag");

		//create a new reviewTag and insert it into mySQL
		$reviewTag = new ReviewTag($this->review->getReviewId(), $this->tag->getTagId());
		$reviewTag->insert($this->getPDO());

		//grab the data from mySQL and enforce that the fields match our expectations
		$results = ReviewTag::getReviewTagByTagId($this->getPDO(), $reviewTag->getReviewTagTagId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("reviewTag"));
		$this->assertCout(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\BrewCrew\\ReviewTag", $results);

		//grab the results from the array and validate them
		$pdoReviewTag = $results[0];
		$this->assertEquals($pdoReviewTag->getReviewTagReviewId(), $this->review->getReviewId());
		$this->assertEquals($pdoReviewTag->getReviewTagTagId(), $this->tag->getTagId());
	}

	/**
	 * testing get reviewTag by invalid tag id
	 */
	public function getReviewTagByInvalidReviewTagTagId() {

		//grab a tag id that exceeds maximum allowed
		$reviewTag = ReviewTag::getReviewTagByTagId($this->getPDO(), BrewCrewTest::INVALID_KEY);
		$this->assertNull($reviewTag);
	}


	/**
	 *testing get reviewTag by valid review id, tag id
	 */
	public function getValidReviewTagByBothIds() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("reviewTag");

		//create a new reviewTag and insert it into mySQL
		$reviewTag = new ReviewTag($this->review->getReviewId(), $this->tag->getTagId());
		$reviewTag->insert($this->getPDO());

		//grab the data from mySQL and enforce that the fields match our expectations
		$results = ReviewTag::getReviewTagByBothIds($this->getPDO(), $reviewTag->getReviewTagReviewId(), $reviewTag->getReviewTagTagId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("reviewTag"));
		$this->assertCout(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\BrewCrew\\ReviewTag", $results);

		//grab the results from the array and validate them
		$pdoReviewTag = $results[0];
		$this->assertEquals($pdoReviewTag->getReviewTagReviewId(), $this->review->getReviewId());
		$this->assertEquals($pdoReviewTag->getReviewTagTagId(), $this->tag->getTagId());
	}

	/**
	 * testing get reviewTag by invalid review id, tag id
	 */
	public function getReviewTagByBothIds() {

		//grab a review id that exceeds maximum allowed
		$reviewTag = ReviewTag::getReviewTagByBothIds($this->getPDO(), BrewCrewTest::INVALID_KEY);
		$this->assertNull($reviewTag);
	}



	/**
	 * test grabbing all reviewTags
	 */
	public function getAllReviewTags() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("reviewTag");

		//create a new reviewTag and insert it into mySQL
		$reviewTag = new ReviewTag($this->review->getReviewId(), $this->tag->getTagId());
		$reviewTag->insert($this->getPDO());

		//grab the data from mySQL and enforce that the fields match our expectations
		$results = ReviewTag::getAllReviewTags($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("reviewTag"));
		$this->assertCout(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\BrewCrew\\ReviewTag", $results);

		//grab the results from the array and validate them
		$pdoReviewTag = $results[0];
		$this->assertEquals($pdoReviewTag->getReviewTagReviewId(), $this->review->getReviewId());
		$this->assertEquals($pdoReviewTag->getReviewTagTagId(), $this->tag->getTagId());
	}

}