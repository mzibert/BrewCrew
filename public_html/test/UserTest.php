<?php
namespace Edu\Cnm\Agraham14\BrewCrew\Test;
use Edu\Cnm\Agraham14\BrewCrew\{User};
// grab the project test parameters
require_once("BrewCrewTest.php");
require_once("User.php");
// grab the class under scrutiny
require_once(dirname(__DIR__) . "/php/classes/autoload.php");
/**
 * Full PHPUnit test for the User class
 *
 * This is a complete PHPUnit test of the User class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see User
 * @author Arlene Carol Graham <agraham14@cnm.edu>
 **/
class UserTest extends BrewCrewTest {
	/**
	 * date of birth of the User
	 * @var Date $VALID_USERDATEOFBIRTH
	 **/
	protected $VALID_USERDATEOFBIRTH = "PHPUnit test passing";
	/**
	 * email of the User
	 * @var string $VALID_USEREMAIL
	 **/
	protected $VALID_USEREMAIL = "PHPUnit test still passing";
	/**
	 * test of User first name
	 * @string $VALID_USERFIRSTNAME
	 **/
	protected $VALID_USERFIRSTNAME;
	/**
	 * test of User last name
	 * @string $VALID_USERLASTNAME
	 **/
	protected $VALID_USERLASTNAME;
	/**
	 * test of User first name
	 * @string $VALID_USERFIRSTNAME
	 **/
	protected $VALID_USERFIRSTNAME;