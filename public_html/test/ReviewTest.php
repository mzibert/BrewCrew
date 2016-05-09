<?php
namespace Edu\Cnm\BrewCrew\Test;

use Edu\Cnm\BrewCrew\{Brewery, User, Beer, Review};

//grab the project test parameters
require_once ("BrewCrewTest.php");

//grab the class under scrutiny--being tested
require_once (dirname(__DIR__) . "../php/classes/autoload.php");

/**
 * Full PHPUnit test for the review class
 *
 * This is a complete PHPUnit test of the review class.  It is considered complete because *ALL* mySQL/PDO enabled methods are tested for both invalid, and for valid inputs.
 *
 * @see \Edu\Cnm\BrewCrew\Review
 * @author Alicia Broadhurst <abroadhurst@cnm.edu>
 */

class ReviewTest extends BrewCrewTest {
	/**
	 * content generated for review text
	 * @var string $VALID_REVIEWCONTENT
	 */
	protected $VALID_REVIEWCONTENT = "Some review text! So PHP test has passed! FTW!";
	
	/**
	 * updated content for review text
	 * @var string $VALID_REVIEWCONTENT2
	 */
	protected $VALID_REVIEWCONTENT2 = "This has changed! PHP test still passes! FTW!";
	
	/**
	 * timestamp for the review; this starts as null and is assigned later
	 * @var \DateTime $VALID_REVIEWDATE
	 */
	protected $VALID_REVIEWDATE = null;
	
	/**
	 * 5-pint rating associated with the review
	 * @var int $VALID_REVIEWPINTRATING
	 */
	protected $VALID_REVIEWPINTRATING = 5;
	
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
	 * Create dependent objects before running each test AKA foreign objects(keys)
	 */
	public final function setUp() {
		//run the default setUp method first
		parent::setUp();

		//create and insert a brewery to own the reviewed beer
		$this->brewery = new Brewery(null, "description of Test Brewery", "2005", "24/7 8 days a week", "The middle of nowhere", "Test Brewery", "1238675309", "www.awesometestbrewery.com");
		$this->brewery->insert($this->getPDO());

		//create and insert a beer that is being reviewed
		$this->beer = new Beer(null, null, 10.5, "available whenever we like it to be", "lots of awards we don't care to name", .5, "something something about the taste.", "50", "Teh Awesome Beer", "Lager");
		$this->beer->insert($this->getPDO());

		//create and insert a user that owns the review being tested
		$this->user = new User(null, null, 0, "token", '1980-01-01', "anon@test.com", "John", "d3f5cd178c01bff44f6be00eb0d5d0a0cb3d5275a641fa11e41739ae1ed7c717d9c0cbf08912836d63715c1e5116df38b505c72f762a737a88d964e435dc78a1", "Smith", "cfad559b8d496bac9af4dbfc0bf5ebdd", "beerfan4lyfe");
		$this->user->insert($this->getPDO());

		//Calculate the date
		$this->VALID_REVIEWDATE = new \DateTime();
	}
	
	/**
	 * test that inserts a valid review and then verifies that the mySQL data matches; also good for getReviewByReviewId check
	 */
	public function testInsertValidReview() {
		//count the number of rows and save this for later
		$numRows = $this->getConnection()->getRowCount("review");

		//create a new review and insert it into mySQL
		$review = new Review(null, $this->beer->getReviewBeerId(), $this->user->getReviewUserId(), $this->VALID_REVIEWDATE, $this->VALID_REVIEWPINTRATING, $this->VALID_REVIEWCONTENT);
		$review->insert($this->getPDO());

		//grab the data from mySQL and check the fields against our expectations
		$pdoReview = Review::getReviewByReviewId($this->getPDO(), $review->getReviewId());
		$this->assertEquals($numRows +1, $this->getConnection()->getRowCount("review"));
		$this->assertEquals($pdoReview->getReviewBeerId(), $this->beer->getReviewBeerId());
		$this->assertEquals($pdoReview->getReviewUserId(), $this->user->getReviewUserId());
		$this->assertEquals($pdoReview->getReviewDate(), $this->VALID_REVIEWDATE);
		$this->assertEquals($pdoReview->getReviewPintRating(), $this->VALID_REVIEWPINTRATING);
		$this->assertEquals($pdoReview->getReviewText(), $this->VALID_REVIEWCONTENT);
	}
	
	/**
	 * test that inserts a review that already exists
	 *
	 * @expectedException PDOException
	 */
	//create a review that has a non-null primary key (review id) and watch it fail
	public function testInsertInvalidReview() {
		$review = new Review(BrewCrewTest::INVALID_KEY, $this->beer->getReviewBeerId(), $this->user->getReviewUserId(), $this->VALID_REVIEWDATE, $this->VALID_REVIEWPINTRATING, $this->VALID_REVIEWCONTENT);
		$review->insert($this->getPDO());
	}
	
	/**
	 * Test that inserts a review, edits and then updates the review
	 */
	public function testUpdateValidReview () {
		//count the number of rows and save for later
		$numRows = $this->getConnection()->getRowCount("review");
		//create a new review and insert it in mySQL database
		$review = new Review(null, $this->beer->getReviewBeerId(), $this->getReviewUserId(), $this->VALID_REVIEWDATE, $this->VALID_REVIEWPINTRATING, $this->VALID_REVIEWCONTENT);
		$review->insert($this->getPDO());

		//edit this review and update it in mySQL
		$review->setReviewContent($this->VALID_REVIEWCONTENT2);
		$review->update($this->getPDO());

		//grab the data from mySQL and check that the fields match our expectations
		$pdoReview = Review::getReviewByReviewId($this->getPDO(), $review->getReviewId());
		$this->assertEquals($numRows +1, $this->getConnection()->getRowCount("review"));
		$this->assertEquals($pdoReview->getReviewBeerId(), $this->beer->getReviewBeerId());
		$this->assertEquals($pdoReview->getReviewUserId(), $this->user->getReviewUserId());
		$this->assertEquals($pdoReview->getReviewDate(), $this->VALID_REVIEWDATE);
		$this->assertEquals($pdoReview->getReviewPintRating(), $this->VALID_REVIEWPINTRATING);
		$this->assertEquals($pdoReview->getReviewText(), $this->VALID_REVIEWCONTENT2);
	}
	
	/**
	 * test that tries updating a review that already exists
	 *
	 * @expectedException PDOException
	 */
	public function testUpdateInvalidReview() {
		//create a review with a non-null id and watch it fail
		$review = new Review(null, $this->beer->getReviewBeerId(), $this->getReviewUserId(), $this->VALID_REVIEWDATE, $this->VALID_REVIEWPINTRATING, $this->VALID_REVIEWCONTENT);
		$review->update($this->getPDO());
	}
	
	/**
	 * test that creates a review and then deletes it
	 */
	public function testDeleteValidReview() {
		//count the number of rows and save for later
		$numRows = $this->getConnection()->getRowCount("review");

		//create a new review and insert it in mySQL database
		$review = new Review(null, $this->beer->getReviewBeerId(), $this->getReviewUserId(), $this->VALID_REVIEWDATE, $this->VALID_REVIEWPINTRATING, $this->VALID_REVIEWCONTENT);
		$review->insert($this->getPDO());

		//delete this review from mySQL database
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("review"));
		$review->delete($this->getPDO());

		//grab the data from mySQL and check that it doesn't exist
		$pdoReview = Review::getReviewbyReviewId($this->getPDO(), $review->getReviewId());
		$this->assertNull($pdoReview);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("review"));
	}

	/**
	 * test deleting a review that does not exist
	 *
	 * @expectedException PDOException
	 */
	public function testDeleteInvalidReview() {
		//create a review and then try to delete it without actually inserting it in database
		$review = new Review(null, $this->beer->getReviewBeerId(), $this->getReviewUserId(), $this->VALID_REVIEWDATE, $this->VALID_REVIEWPINTRATING, $this->VALID_REVIEWCONTENT);
		$review->delete($this->getPDO());
	}
	
	/**
	 * test grabbing a review that doesn't exist from the database
	 */
	public function testGetInvalidReviewByReviewId() {
		//grab a review id that exceeds maximum allowable id limit
		$review = Review::getReviewByReviewId($this->getPDO(), BrewCrewTest::INVALID_KEY);
		$this->assertNull($review);
	}
	
	/**
	 * test grabbing a review by pint rating
	 */
	public function testGetReviewByReviewPintRating() {
		//count the number of rows and save this for later
		$numRows = $this->getConnection()->getRowCount("review");

		//create a new review and insert it into mySQL
		$review = new Review(null, $this->beer->getReviewBeerId(), $this->user->getReviewUserId(), $this->VALID_REVIEWDATE, $this->VALID_REVIEWPINTRATING, $this->VALID_REVIEWCONTENT);
		$review->insert($this->getPDO());

		//grab the data from mySQL and check the fields against our expectations
		$results = Review::getReviewByReviewPintRating($this->getPDO(), $review->getReviewId());
		$this->assertEquals($numRows +1, $this->getConnection()->getRowCount("review"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\BrewCrew\\Review", $results);

		//grab the result from the resulting array and validate it
		$pdoReview = $results[0];
		$this->assertEquals($pdoReview->getReviewBeerId(), $this->beer->getReviewBeerId());
		$this->assertEquals($pdoReview->getReviewUserId(), $this->user->getReviewUserId());
		$this->assertEquals($pdoReview->getReviewDate(), $this->VALID_REVIEWDATE);
		$this->assertEquals($pdoReview->getReviewPintRating(), $this->VALID_REVIEWPINTRATING);
		$this->assertEquals($pdoReview->getReviewText(), $this->VALID_REVIEWCONTENT);
	}

	/**
	 * test grabbing a review by pint rating that doesn't exist
	 */
	public function testGetInvalidReviewByPintRating() {
		//grab a review by looking for reviews with no applicable pint ratings
		$review = Review::getReviewByReviewPintRating($this->getPDO(), 42);
		$this->assertCount(0, $review);
	}

	/**
	 * test grabbing all the reviews
	 */
	public function testGetAllValidReviews() {
		//count the number of rows and save this for later
		$numRows = $this->getConnection()->getRowCount("review");

		//create a new review and insert it into mySQL
		$review = new Review(null, $this->beer->getReviewBeerId(), $this->user->getReviewUserId(), $this->VALID_REVIEWDATE, $this->VALID_REVIEWPINTRATING, $this->VALID_REVIEWCONTENT);
		$review->insert($this->getPDO());

		//grab the data from mySQL and check the fields against our expectations
		$results = Review::getReviewByReviewPintRating($this->getPDO(), $review->getReviewId());
		$this->assertEquals($numRows +1, $this->getConnection()->getRowCount("review"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\BrewCrew\\", $results);

		//grab the results from the array and validate it
		$pdoReview = $results[0];
		$this->assertEquals($pdoReview->getReviewBeerId(), $this->beer->getReviewBeerId());
		$this->assertEquals($pdoReview->getReviewUserId(), $this->user->getReviewUserId());
		$this->assertEquals($pdoReview->getReviewDate(), $this->VALID_REVIEWDATE);
		$this->assertEquals($pdoReview->getReviewPintRating(), $this->VALID_REVIEWPINTRATING);
		$this->assertEquals($pdoReview->getReviewText(), $this->VALID_REVIEWCONTENT);
	}
}
