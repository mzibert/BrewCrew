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

/**
 * Full PHPUnit test for brewery class
 *
 * This is a complete PHPUnit test of the brewery class. It is complete because "ALL" mySQL/PDO enabled methods are tested for both invalid and valid inputs.
 *
 * @see \Edu\Cnm\BrewCrew\Brewery
 * @author Kate McGaughey therealmcgaughey@gmail.com
 *
 */

class TagTest extends BrewCrewTest {
	/**
	 * Content generated for description text
	 * @var string $VALID_TAGID
	 */
	protected $VALID_BREWERY_DESCRIPTION = "PHPUnit test passing";

	/**
	 * Updated content for description text
	 * @var string $VALID_BREWERYEST_DESCRIPTION2
	 */
	protected $VALID_BREWERY_DESCRIPTION2 = "PHPUnit test still passing";









/**
* Test getting all tags
*/