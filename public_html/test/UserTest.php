<?php
namespace Edu\Cnm\BrewCrew\Test;

use Edu\Cnm\BrewCrew\{User, Brewery};
use PDOException;

//grab the project test parameters
require_once ("BrewCrewTest.php");

//grab the class under scrutiny--being tested
require_once (dirname(__DIR__) . "/php/classes/autoload.php");
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
	/**
	 * @var int $userBreweryId
	 */
	protected $brewery = null;
	/**
	 * @var int $userAccessLevel
	 */
	protected $VALID_ACCESSLEVEL = "1";
	/**
	 * @var string $newUserActivationToken int with user token
	**/
	protected $VALID_ACTIVATIONTOKEN = "ceegb";
	/**
	 * @var \DateInterval|\DateTime|null|string  $newUserDateOfBirth date User was sent or null if set to current date and time
	 */
	protected $VALID_DATEOFBIRTH = "1960-12-25 00:00:00";


	/**
	 * @var string $newUserEmail string containing user email
	 */
	protected $VALID_EMAIL = "email@email.com";
	/**
	 * @var string $newUserEmail string containing user email
	 */
	protected $VALID_EMAIL2 = "email2@email.com ";
	/**
	 * Invalid Email string
	 * @var string
	 */
	protected $INVALID_EMAIL = "email@email";

	/**
	 * valid firstName of userId
	 * @var string $firstName
	 **/
	protected $VALID_FIRSTNAME = "Arlene";
	/**
	 * @var string hash
	 */
	private $hash;
	/**
	 * valid lastName of userId
	 * @var string $lastName
	 **/
	protected $VALID_LASTNAME = "Graham";
	/**
	 * @var string salt
	 */
	private $salt;
	/**
	 * user
	 * @var string userUsername
	 **/
	protected $VALID_USERUSERNAME = "ABQBrewCrew";


	private $password = "password";

	//create dependent objects before running each test
	public final function setUp () {
		//run the default setUp() method first
		parent::setUp();
		//create and insert a Brewery to own the test user
		$this->brewery = new Brewery(null, "brewery description", "2016", "7am - 11pm", "location", "Marble Brewery", "15055551212", "Marble@Marble.com");
		//var_dump($this->brewery);
		$this->brewery->insert($this->getPDO());

		//create salt and hash for user
		$this->salt = bin2hex(random_bytes(16));
		$this->hash = hash_pbkdf2("sha512", $this->password, $this->salt, 262144);
	}

	//test inserting a valid USER and verify that it matches the mySQL data
	public function testInsertValidUser () {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
//
//
//		//create a new user and insert it into mySQL
		$user = new User(null, $this->brewery->getBreweryId(),$this->VALID_ACCESSLEVEL,$this->VALID_ACTIVATIONTOKEN,$this->VALID_DATEOFBIRTH, $this->VALID_EMAIL,$this->VALID_FIRSTNAME,$this->hash,$this->VALID_LASTNAME, $this->salt,$this->VALID_USERUSERNAME);
		$user->insert($this->getPDO());
//		//grab the data from mySQL and enforce the fields to match our expectations
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertSame($pdoUser->getUserAccessLevel(), $this->VALID_ACCESSLEVEL);
		$this->assertSame($pdoUser->getUserActivationToken(),$this->VALID_ACTIVATIONTOKEN);
		$this->assertSame($pdoUser->getUserDateOfBirth(),$this->VALID_DATEOFBIRTH);
		$this->assertSame($pdoUser->getUserEmail(), $this->VALID_EMAIL);
		$this->assertSame($pdoUser->getUserFirstName(), $this->VALID_FIRSTNAME);
		$this->assertSame($pdoUser->getUserHash(), $this->hash);
		$this->assertSame($pdoUser->getUserLastName(), $this->VALID_LASTNAME);
		$this->assertSame($pdoUser->getUserSalt(), $this->salt);
		$this->assertSame($pdoUser->getUserUsername(), $this->VALID_USERUSERNAME);

	}


	/**
	 * test inserting a User, editing it, and then updating it by changing user email
 **/
	public function testUpdateValidUser() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		// create a new User and insert to into mySQL
		$user = new User(null, $this->VALID_ACCESSLEVEL,$this->VALID_ACTIVATIONTOKEN,$this->VALID_DATEOFBIRTH, $this->VALID_EMAIL, $this->VALID_FIRSTNAME, $this->hash, $this->VALID_LASTNAME, $this->salt, $this->VALID_USERUSERNAME);
		$user->insert($this->getPDO());

		$user->insert($this->getPDO());
		// edit the user and update it in mySQL
		$user->setUserEmail($this->VALID_EMAIL2);
		$user->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match

		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));

		$this->assertSame($pdoUser->getUserAccessLevel(), $this->VALID_ACCESSLEVEL);
		$this->assertSame($pdoUser->getUserActivationToken(),$this->VALID_ACTIVATIONTOKEN);
		$this->assertSame($pdoUser->getUserDateOfBirth(),$this->VALID_DATEOFBIRTH);
		$this->assertSame($pdoUser->getUserEmail(), $this->VALID_EMAIL2);
		$this->assertSame($pdoUser->getUserFirstName(), $this->VALID_FIRSTNAME);
		$this->assertSame($pdoUser->getUserHash(), $this->hash);
		$this->assertSame($pdoUser->getUserLastName(), $this->VALID_LASTNAME);
		$this->assertSame($pdoUser->getUserSalt(), $this->salt);
		$this->assertSame($pdoUser->getUserUsername(), $this->VALID_USERUSERNAME);


	}

	/**
	 * test creating a User and then deleting it
	 **/
	public function testDeleteValidUser() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		// create a new User and insert to into mySQL
		$user = new User(null,$this->user->getUserId(),
			$this->VALID_ACCESSLEVEL,
			$this->VALID_ACTIVATIONTOKEN,
			$this->VALID_DATEOFBIRTH,
			$this->VALID_EMAIL,
			$this->VALID_FIRSTNAME,
			$this->hash,
			$this->VALID_LASTNAME,
			$this->salt,
			$this->VALID_USERUSERNAME);
		$user->insert($this->getPDO());
		// delete the User from mySQL
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("user"));
		$user->delete($this->getPDO());
		// grab the data from mySQL and enforce the User does not exist
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertNull($pdoUser);
		$this->assertSame($numRows, $this->getConnection()->getRowCount("user"));
	}



	/**
	 * test inserting a User and regrabbing it from mySQL
	 **/
	public function testGetValidUserByUserId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		// create a new user and insert to into mySQL
		$user = new User(null, $this->VALID_ACCESSLEVEL,$this->VALID_ACTIVATIONTOKEN,$this->VALID_DATEOFBIRTH, $this->VALID_EMAIL, $this->VALID_FIRSTNAME, $this->hash, $this->VALID_LASTNAME, $this->salt, $this->VALID_USERUSERNAME);
		$user->insert($this->getPDO());
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		// grab the data from mySQL and enforce the fields match
		$this->assertSame($pdoUser->getUserAccessLevel(), $this->VALID_ACCESSLEVEL);
		$this->assertSame($pdoUser->getUserActivationToken(),$this->VALID_ACTIVATIONTOKEN);
		$this->assertSame($pdoUser->getUserDateOfBirth(),$this->VALID_DATEOFBIRTH);
		$this->assertSame($pdoUser->getUserEmail(), $this->VALID_EMAIL);
		$this->assertSame($pdoUser->getUserFirstName(), $this->VALID_FIRSTNAME);
		$this->assertSame($pdoUser->getUserHash(), $this->hash);
		$this->assertSame($pdoUser->getUserLastName(), $this->VALID_LASTNAME);
		$this->assertSame($pdoUser->getUserSalt(), $this->salt);
		$this->assertSame($pdoUser->getUserUsername(), $this->VALID_USERUSERNAME);
	}
	/**
	//	 * test grabbing a User by email
	//	 **/
	public function testGetValidUserByUserEmail() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		// create a new User and insert to into mySQL
		$user = new User(null, $this->VALID_ACCESSLEVEL,$this->VALID_EMAIL, $this->VALID_FIRSTNAME, $this->hash, $this->VALID_LASTNAME, $this->salt, $this->VALID_USERUSERNAME);
		$user->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserEmail($this->getPDO(), $this->VALID_EMAIL);
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertSame($pdoUser->getUserAccessLevel(), $this->VALID_ACCESSLEVEL);
		$this->assertSame($pdoUser->getUserActivationToken(),$this->VALID_ACTIVATIONTOKEN);
		$this->assertSame($pdoUser->getUserDateOfBirth(),$this->VALID_DATEOFBIRTH);
		$this->assertSame($pdoUser->getUserEmail(), $this->VALID_EMAIL);
		$this->assertSame($pdoUser->getUserFirstName(), $this->VALID_FIRSTNAME);
		$this->assertSame($pdoUser->getUserHash(), $this->hash);
		$this->assertSame($pdoUser->getUserLastName(), $this->VALID_LASTNAME);
		$this->assertSame($pdoUser->getUserSalt(), $this->salt);
		$this->assertSame($pdoUser->getUserUsername(), $this->VALID_USERUSERNAME);
	}



}
