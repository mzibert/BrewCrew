<?php
namespace Edu\Cnm\BrewCrew\Test;
// grab the project test parameters
use Edu\Cnm\BrewCrew\Tag;

require_once ("BrewCrewTest.php");

// Grab the class being tested
require_once (dirname(__DIR__) . "/php/classes/autoload.php");

/**
 * Full PHPUnit test for tag class
 *
 * This is a complete PHPUnit test of the tag class.
 *
 * @see \Edu\Cnm\BrewCrew\Tag
 * @author Kate McGaughey therealmcgaughey@gmail.com
 *
 */

class TagTest extends BrewCrewTest {

	/**
	 * Valid flavor label to use
	 * @var string $VALID_TAG_LABEL
	 */
	protected $VALID_TAG_LABEL = "Sweet";


	/**
	 * Test inserting a valid tag and verifying that the mySQL data matches
	 */
	public function testInsertValidTag() {
	
	}


	/**
	 * Test inserting a tag that already exists
	 */


	/**
	 * Test creating a tag and then deleting it
	 */


	/**
	 * Test deleting a tag that doesn't exist
	 */


	/**
	 * Test getting a tag by valid tag id
	 */


	/**
	 * Test getting a tag by invalid tag id
	 */


	/**
	 * Test getting tag by tag label
	 */


	/**
	 * Test getting all tags
	 */
}