<?php
namespace Edu\Cnm\mzibert\BrewCrew\Test;

use Edu\Cnm\BrewCrew\{Beer, Brewery};

//grab the project test parameters
require_once("BrewCrewTest.php");

//grab the class under scrutiny
require_once(()."php/classes/autoload.php)");

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
	 * Ibu of the Beer
	 * @var int $VAILID_BEERIBU
	 **/
	protected $VAILID_BEERIBU = "PHPUnit test passing";
	/**
	 * content of the update beer Ibu
	 * @var int $VALID_BEERIBU2
	 **/
	protected $VALID_BEERIBU2 = "PHPUnit test still passing";
	/**
	 *
	 */

}



