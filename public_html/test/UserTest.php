<?php
namespace Edu\Cnm\BrewCrew\Test;

use Edu\Cnm\BrewCrew;
//grab the project test parameters
require_once ("BrewCrewTest.php");

//grab the class under scrutiny--being tested
require_once (dirname(__DIR__) . "../php/classes/autoload.php");
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
	 * user
	 * @var string $VALID_USER
	 */
	protected $VALID_EMAIL = "PHPUnit test passing";

	protected $VALID_EMAIL3 = "PHPUnit test passing again";
	/**
	 * user
	 * @var string $VALID_USER2
	 **/
	protected $VALID_USERUSERNAME = "PHPUnit test still passing";

	protected $brewery = null;

	//create dependent objects before running each test
	public final function setUp () {
		//run the default setUp() method first
		parent::setUp();
		//create and insert a Brewery to own the test user
		$this->brewery = new Brewery(null, "@phpunit", "@testphpunit.de", "12125551212");
		$this->brewery->insert($this->getPDO());
		$this->VALID_EMAIL = new \User();

	}

	//test inserting a valid email and verify that it matches the mySQL data
	public function testInsertValidUser ($pdoUserUsername, $pdoBrewery) {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("Email");
		//create a new user and insert it into mySQL
		$User = new User(null, $this->User->getUserId(), $this->VALID_EMAIL, $this->VALID_USERUSERNAME);
		$User->insert($this->getPDO());
		//grab the data from mySQL and enforce the fields to match our expectations
		$pdoUser = User::getUserbyUserID($this->getPDO(), $User->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserEmail(), $this->User->getUserEmail());
		$this->assertEquals($pdoUserUsername->getUserUsername(), $this->userUsername->getUserUsername());
		$this->assertEquals($pdoBrewery->getBrewery(), $this->Brewery->getBrewery());

	}
	//test inserting something that already exists
	//expecting PDOException
	public function testInsertInvalidUser($getUserId) {
		$User = new User(UserTest::INVALID_KEY, $this->User->$getUserId(), $this->VALID_EMAIL, $this->VALID_USERNAME);
		$User->insert($this->getPDO());
	}
	//test creating a user, editing it, and then updating it
	public function testUpdateValidUser($User, $pdoUser) {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		//create a new user and update it into mySQL
		$User->setUserbyUserId($this->getPDO(), $User->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $this->user->getUserId());
		$this->assertEquals($pdoUser->getEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoUser->getBREWERY(), $this->VALID_BREWERY);
	}
	//test updating a user that already exists
//@expectedException PDOException
	public function testUpdateInvalidUser($User) {
		//create a user with a non null user id to watch it fail
		$User = new User(null, $this->User->getUserId(), $this->VALID_EMAIL, $this->VALID_BREWERY);
		$User->update($this->getPDO());
	}
	//test creating a User then deleting it
	public function testDeleteValidUser() {
		//count rows
		$numRows = $this->getConnection()->getRowCount("User");
		//create a new User and insert into mySQL
		$User = new User(null, $this->User->getUserId(), $this->VALID_EMAIL, $this->VALID_BREWERY);
		$User->insert($this->getPDO());
		//delete this User from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("User"));
		$User->delere($this->getPDO());
		//grab the data from mySQL and enforce the User does not exist
		$pdoUser = User::GetUserbyUserId($this->getPDO(), $User->getUserId());
		$this->assertNul($pdoUser);
		$User->assertEquals($numRows, $this->User->getConnection()->getRowCount("User"));
	}
	//test grabbing a User that does not exist
	public function testGetInvalidUserbyUserId() {
		//grab a profile id that exceeds the maximum allowable profile id
		$User = User::getUserbyUserId($this->getPDO(), UserTest::INVALID_KEY);
		$this->assertNull($User);
	}
//test grabbing a User by Email
	public function testGetInvalidUserByEmail($User) {
		//count number of rows
		$numRows = $this->getConnection()->getRowCount("User");
		// create a new User and insert to into mySQL
		$tweet = new User(null, $this->UserEmail->getUserEmailId(), $this->VALID_EMAIL, $this->VALID_BREWERY);
		$tweet->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$results = User::getUserByUserId($this->getPDO(), $User->getUserEmail());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("User"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\BrewCrew\\Test\\UserTest", $results);
		// grab the result from the array and validate it
		$pdoUser = $results[0];
		$this->assertEquals($pdoUser->getUserId(), $this->User->getUserId());
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoUser->getBrewery(), $this->VALID_BREWERY);
	}

	//test grabbing all users
	public function testGetAllValidUsers() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("User");
		// create a new User and insert to into mySQL
		$User = new User(null, $this->User->getUserId(), $this->VALID_EMAIL, $this->VALID_BREWERY);
		$User->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$results = User::getAllUsers($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Users"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\BrewCrew\\Test\\UserTest", $results);
		// grab the result from the array and validate it
		$pdoUser = $results[0];
		$this->assertEquals($pdoUser->getUserId(), $this->User->getUserId());
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoUser->getBrewery(), $this->VALID_LBREWERY);
	}
}