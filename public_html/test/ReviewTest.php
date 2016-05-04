<?php
namespace Edu\Cnm\BREWCREW\Test;

//FIXME update this with the right namespace
use Edu\Cnm\BREWCREW\{}; //NEED TO LIST ALL THE CLASSES I NEED?

//grab the project test parameters
require_once ("BrewCrewTest.php");

//grab the class under scrutiny--being tested
require_once (dirname(__DIR__) . "../php/classes/autoload.php");

/**
 * Full PHPUnit test for the review class
 *
 * This is a complete PHPUnit test of the review class.  It is considered complete because *ALL* mySQL/PDO enabled methods are tested for both invalid, and for valid inputs.
 *
 * @see \Edu\Cnm\BREWCREW\Review
 * @author Alicia Broadhurst <abroadhurst@cnm.edu>
 *
 */

class ReviewTest extends BrewCrewTest {
	/**
	 * content generated for review text
	 * @var string $VALID_REVIEWCONTENT
	 */
	protected $VALID_REVIEWCONTENT = "Some review text! So PHP test has passed! FTW!"
	/**
	 * updated content for review text
	 * @var string $VALID_REVIEWCONTENT2
	 */
	protected $VALID_REVIEWCONTENT2 = "This has changed! PHP test still passes! FTW!"
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
	
	//QUESTION Ask if this is correct for brewery.  Not a foreign key being referred to directly in review, but is required for beer, etc.
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
		$this->brewery = new Brewery(null, "Test Brewery") //QUESTION do I need to fill in all the fields? what about the uneccesary ones?

		//create and insert a beer that is being reviewed

		//create and insert a user that owns the review being tested
	}
}

