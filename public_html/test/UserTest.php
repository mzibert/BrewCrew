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
	 * Valid userId
	 * @var int
	 */
	protected $VALID_USERID = "10";


	protected $VALID_ACCESSLEVEL = "PHPUnit test passing";
	/**
	 * @var int $newUserActivationToken int with user token
	 */
	protected $VALID_ACTIVATIONTOKEN = "PHPUnit test passing";
	/**
	 * @var \DateTime $newUserDateOfBirth date User was sent or null if set to current date and time
	 */
	protected $VALID_DATEOFBIRTH = "PHPUnit test passing";
	/**
	 * @var string $newUserEmail string containing user email
	 */
	protected $VALID_EMAIL = "email@email.com";
	/**
	 * @var string $newUserEmail string containing user email
	 */
	protected $VALID_EMAIL2 = "email2@email.co ";

	/**
	 * valid firstName of userId
	 * @var string $firstName
	 **/
	protected $VALID_FIRSTNAME = "Arlene";
	/**
	 * valid lastName of userId
	 * @var string $lastName
	 **/
	protected $VALID_LASTNAME = "Graham";
	/**
	 * user
	 * @var string userUsername
	 **/
	protected $VALID_USERUSERNAME = "PHPUnit test still passing";

	protected $brewery = null;

	private $salt;
	private $hash;
	private $password = "password";

	//create dependent objects before running each test
	public final function setUp () {
		//run the default setUp() method first
		parent::setUp();
		//create and insert a Brewery to own the test user
		$this->brewery = new Brewery(null, "brewery description", "2016", "7am - 11pm", "location", "Marble Brewery", "15055551212", "Marble@Marble.com");
		$this->brewery->insert($this->getPDO());
		$this->VALID_EMAIL = new \User();

	}

	//test inserting a valid USER and verify that it matches the mySQL data
	public function testInsertValidUser () {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("User");

		//create salt and hash for user
		$this->salt = bin2hex(16);
		$this->hash = hash_pbkdf2("sha512", $this->password, $this->salt, 4096);

		//create a new user and insert it into mySQL
		$User = new User(null, $this->VALID_ACCESSLEVEL,$this->VALID_ACTIVATIONTOKEN, $this->VALID_DATEOFBIRTH, $this->VALID_EMAIL,$this->VALID_FIRSTNAME,$this->hash,$this->VALID_LASTNAME, $this->salt,$this->VALID_USERUSERNAME);
		$User->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields to match our expectations
		$pdoUser = User::getUserbyUserID($this->getPDO(), $User->getUserId());

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertSame($pdoUser->getUserAccessLevel(), $this->VALID_ACCESSLEVEL);
		$this->assertSame($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATIONTOKEN);
		$this->assertSame($pdoUser->getUserDateOfBirth(), $this->VALID_DATEOFBIRTH);
		$this->assertSame($pdoUser->getUserEmail(), $this->VALID_EMAIL);
		$this->assertSame($pdoUser->getUserFirstName(), $this->VALID_FIRSTNAME);
		$this->assertSame($pdoUser->getUserHash(), $this->hash);
		$this->assertSame($pdoUser->getUserLastName(), $this->VALID_LASTNAME);
		$this->assertSame($pdoUser->getUserSalt(), $this->salt);
		$this->assertSame($pdoUser->getUserUsername(), $this->VALID_USERUSERNAME);

	}
	/**
	 * test inserting a User that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidUser() {
		// create a profile with a non null profileId and watch it fail

		$User = new User(null, $this->VALID_ACCESSLEVEL,$this->VALID_ACTIVATIONTOKEN, $this->VALID_DATEOFBIRTH, $this->VALID_EMAIL,$this->VALID_FIRSTNAME,$this->hash,$this->VALID_LASTNAME, $this->salt,$this->VALID_USERUSERNAME);
		$User->insert($this->getPDO());
		$User->insert($this->getPDO());
	}
	/**
	 * test grabbing a User by email
	 **/
	public function testGetValidUserByEmail() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		// create a new User and insert to into mySQL
		$User = new User(null, $this->VALID_ACCESSLEVEL, $this->VALID_ACTIVATIONTOKEN, $this->VALID_DATEOFBIRTH, $this->VALID_EMAIL, $this->VALID_FIRSTNAME, $this->hash, $this->VALID_LASTNAME, $this->salt, $this->VALID_USERUSERNAME);
		$User->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByEmail($this->getPDO(), $this->VALID_email);
		$this->assertSame($pdoUser->getUserAccessLevel(), $this->VALID_ACCESSLEVEL);
		$this->assertSame($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATIONTOKEN);
		$this->assertSame($pdoUser->getUserDateOfBirth(), $this->VALID_DATEOFBIRTH);
		$this->assertSame($pdoUser->getUserEmail(), $this->VALID_EMAIL);
		$this->assertSame($pdoUser->getUserFirstName(), $this->VALID_FIRSTNAME);
		$this->assertSame($pdoUser->getUserHash(), $this->hash);
		$this->assertSame($pdoUser->getUserLastName(), $this->VALID_LASTNAME);
		$this->assertSame($pdoUser->getUserSalt(), $this->salt);
		$this->assertSame($pdoUser->getUserUsername(), $this->VALID_USERUSERNAME);
	}
	/**
	 * test grabbing a User by an email that does not exists
	 **/
	public function testGetInvalidUserByEmail() {
		// grab an email that does not exist
		$User = User::getUserByEmail($this->getPDO(), $this->INVALID_email);
		$this->assertNull($User);
	}

	/**
	 * test inserting a User, editing it, and then updating it by changing user email
	 **/
	public function testUpdateValidUser() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		// create a new User and insert to into mySQL
		$User = new User(null, $this->VALID_ACCESSLEVEL, $this->VALID_ACTIVATIONTOKEN, $this->VALID_DATEOFBIRTH, $this->VALID_EMAIL, $this->VALID_FIRSTNAME, $this->hash, $this->VALID_LASTNAME, $this->salt, $this->VALID_USERUSERNAME);
		$User->insert($this->getPDO());

		$User->insert($this->getPDO());
		// edit the user and update it in mySQL
		$User->setUserEmail($this->VALID_EMAIL2);
		$User->update($this->getPDO());


		// grab the data from mySQL and enforce the fields match

		$pdoUser = User::getUserByUserId($this->getPDO(), $User->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));

		$this->assertSame($pdoUser->getUserAccessLevel(), $this->VALID_ACCESSLEVEL);
		$this->assertSame($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATIONTOKEN);
		$this->assertSame($pdoUser->getUserDateOfBirth(), $this->VALID_DATEOFBIRTH);
		$this->assertSame($pdoUser->getUserEmail(), $this->VALID_EMAIL2);
		$this->assertSame($pdoUser->getUserFirstName(), $this->VALID_FIRSTNAME);
		$this->assertSame($pdoUser->getUserHash(), $this->hash);
		$this->assertSame($pdoUser->getUserLastName(), $this->VALID_LASTNAME);
		$this->assertSame($pdoUser->getUserSalt(), $this->salt);
		$this->assertSame($pdoUser->getUserUsername(), $this->VALID_USERUSERNAME);


	}
	/**
	 *
	 * test updating a User that does not exist
	 *
	 **/
	public function testUpdateInvalidUser() {
		// create a User and try to update it without actually inserting it
		$User = new User(null, $this->VALID_ACCESSLEVEL, $this->VALID_ACTIVATIONTOKEN, $this->VALID_DATEOFBIRTH, $this->VALID_EMAIL, $this->VALID_FIRSTNAME, $this->hash, $this->VALID_LASTNAME, $this->salt, $this->VALID_USERUSERNAME);
		$User->insert($this->getPDO());

	}
	/**
	 * test creating a User and then deleting it
	 **/
	public function testDeleteValidUser() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		// create a new User and insert to into mySQL
		$User = new User(null, $this->VALID_ACCESSLEVEL, $this->VALID_ACTIVATIONTOKEN, $this->VALID_DATEOFBIRTH, $this->VALID_EMAIL, $this->VALID_FIRSTNAME, $this->hash, $this->VALID_LASTNAME, $this->salt, $this->VALID_USERUSERNAME);
		$User->insert($this->getPDO());
		// delete the User from mySQL
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("user"));
		$User->delete($this->getPDO());
		// grab the data from mySQL and enforce the User does not exist
		$pdoUser = User::getUserByUserId($this->getPDO(), $User->getUserId());
		$this->assertNull($pdoUser);
		$this->assertSame($numRows, $this->getConnection()->getRowCount("user"));
	}
	/**
	 * test deleting a User that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidUser() {
		// create a User and try to delete it without actually inserting it
		$User = new User(null, $this->VALID_ACCESSLEVEL, $this->VALID_ACTIVATIONTOKEN, $this->VALID_DATEOFBIRTH, $this->VALID_EMAIL, $this->VALID_FIRSTNAME, $this->hash, $this->VALID_LASTNAME, $this->salt, $this->VALID_USERUSERNAME);
		$User->delete($this->getPDO());
	}
	/**
	 * test inserting a User and regrabbing it from mySQL
	 **/
	public function testGetValidUserByUserId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		// create a new user and insert to into mySQL
		$User = new User(null, $this->VALID_ACCESSLEVEL, $this->VALID_ACTIVATIONTOKEN, $this->VALID_DATEOFBIRTH, $this->VALID_EMAIL, $this->VALID_FIRSTNAME, $this->hash, $this->VALID_LASTNAME, $this->salt, $this->VALID_USERUSERNAME);
		$User->insert($this->getPDO());
		$pdoUser = User::getUserByUserId($this->getPDO(), $User->getUserId());
		// grab the data from mySQL and enforce the fields match
		$this->assertSame($pdoUser->getUserAccessLevel(), $this->VALID_ACCESSLEVEL);
		$this->assertSame($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATIONTOKEN);
		$this->assertSame($pdoUser->getUserDateOfBirth(), $this->VALID_DATEOFBIRTH);
		$this->assertSame($pdoUser->getUserEmail(), $this->VALID_EMAIL);
		$this->assertSame($pdoUser->getUserFirstName(), $this->VALID_FIRSTNAME);
		$this->assertSame($pdoUser->getUserHash(), $this->hash);
		$this->assertSame($pdoUser->getUserLastName(), $this->VALID_LASTNAME);
		$this->assertSame($pdoUser->getUserSalt(), $this->salt);
		$this->assertSame($pdoUser->getUserUsername(), $this->VALID_USERUSERNAME);
	}
	/**
	 * test grabbing a User that does not exist
	 **/
	public function testGetInvalidUserByUserId() {
		// grab a user id that exceeds the maximum allowable profile id
		$user = User::getUserByUserId($this->getPDO(), InventoryTextTest::INVALID_KEY);
		$this->assertNull($user);
	}
}
