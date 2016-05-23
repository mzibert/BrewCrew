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
	 * @var string $newUserActivationToken string with user token
	**/
	protected $VALID_ACTIVATIONTOKEN = "ceegb";
	/**
	 * @var \DateInterval |\DateTime|null $newUserDateOfBirth date User was sent or null if set to current date and time
	 */
	protected $VALID_DATEOFBIRTH = "1970-12-25";
	/**
	 * @var string $newUserEmail string containing user email
	 */
	protected $VALID_EMAIL = "email@email.com";
	/**
	 * @var string $newUserEmail string containing user email
	 */
	protected $VALID_EMAIL2 = "email2@email.com";
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
	private $hash = null;
	/**
	 * valid lastName of userId
	 * @var string $lastName
	 **/
	protected $VALID_LASTNAME = "Graham";
	/**
	 * @var string salt
	 */
	private $salt = null;
	/**
	 * user
	 * @var string userUsername
	 **/
	protected $VALID_USERUSERNAME = "ABQBrewCrew";


	//private $password = "password";

	//create dependent objects before running each test
	/**
	 *
	 */
	public final function setUp () {
		//run the default setUp() method first
		parent::setUp();
		//create salt and hash for user
;
		$password = "421245";
		$this->salt = bin2hex(random_bytes(32));
		$this->hash = hash_pbkdf2("sha512", $password, $this->salt, 262144);
		//create and insert a Brewery to own the test user
		$this->brewery = new Brewery(null, "brewery description", "2016", "7am - 11pm", "location", "Marble Brewery", "15055551212", "Marble@Marble.com");

		$this->brewery->insert($this->getPDO());

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
		$this->assertEquals($pdoUser->getUserAccessLevel(), $this->VALID_ACCESSLEVEL);
		$this->assertEquals($pdoUser->getUserActivationToken(),$this->VALID_ACTIVATIONTOKEN);
		$this->assertEquals($pdoUser->getUserDateOfBirth()->format("Y-m-d"),$this->VALID_DATEOFBIRTH);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoUser->getUserFirstName(), $this->VALID_FIRSTNAME);
		$this->assertEquals($pdoUser->getUserHash(), $this->hash);
		$this->assertEquals($pdoUser->getUserLastName(), $this->VALID_LASTNAME);
		$this->assertEquals($pdoUser->getUserSalt(), $this->salt);
		$this->assertEquals($pdoUser->getUserUsername(), $this->VALID_USERUSERNAME);

	}


	/**
	 * test inserting a User, editing it, and then updating it by changing user email
 **/
	public function testUpdateValidUser() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		// create a new User and insert to into mySQL
		$user = new User(null,$this->brewery->getBreweryId(), $this->VALID_ACCESSLEVEL,$this->VALID_ACTIVATIONTOKEN,$this->VALID_DATEOFBIRTH, $this->VALID_EMAIL, $this->VALID_FIRSTNAME, $this->hash, $this->VALID_LASTNAME, $this->salt, $this->VALID_USERUSERNAME);
		$user->insert($this->getPDO());
		// edit the user and update it in mySQL
		$user->setUserEmail($this->VALID_EMAIL2);
		$user->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match

		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));

		$this->assertEquals($pdoUser->getUserAccessLevel(), $this->VALID_ACCESSLEVEL);
		$this->assertEquals($pdoUser->getUserActivationToken(),$this->VALID_ACTIVATIONTOKEN);
		$this->assertEquals($pdoUser->getUserDateOfBirth()->format("Y-m-d"),$this->VALID_DATEOFBIRTH);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_EMAIL2);
		$this->assertEquals($pdoUser->getUserFirstName(), $this->VALID_FIRSTNAME);
		$this->assertEquals($pdoUser->getUserHash(), $this->hash);
		$this->assertEquals($pdoUser->getUserLastName(), $this->VALID_LASTNAME);
		$this->assertEquals($pdoUser->getUserSalt(), $this->salt);
		$this->assertEquals($pdoUser->getUserUsername(), $this->VALID_USERUSERNAME);


	}

	/**
	 * test creating a User and then deleting it
	 **/
	public function testDeleteValidUser() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		// create a new User and insert to into mySQL
		$user = new User(null,  $this->brewery->getBreweryId(),
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
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$user->delete($this->getPDO());
		// grab the data from mySQL and enforce the User does not exist
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertNull($pdoUser);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("user"));
	}
	/**
	 * test inserting a User and regrabbing it from mySQL
	 **/
	public function testGetValidUserByUserId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		// create a new user and insert to into mySQL
		$user = new User(null,$this->brewery->getBreweryId(), $this->VALID_ACCESSLEVEL,$this->VALID_ACTIVATIONTOKEN,$this->VALID_DATEOFBIRTH, $this->VALID_EMAIL, $this->VALID_FIRSTNAME, $this->hash, $this->VALID_LASTNAME, $this->salt, $this->VALID_USERUSERNAME);

		$user->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));

		// grab the result from the array and validate it

		$this->assertEquals($pdoUser->getUserBreweryId(),$this->brewery->getBreweryId());
		$this->assertEquals($pdoUser->getUserAccessLevel(), $this->VALID_ACCESSLEVEL);
		$this->assertEquals($pdoUser->getUserActivationToken(),$this->VALID_ACTIVATIONTOKEN);
		$this->assertEquals($pdoUser->getUserDateOfBirth()->format("Y-m-d"),$this->VALID_DATEOFBIRTH);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoUser->getUserFirstName(), $this->VALID_FIRSTNAME);
		$this->assertEquals($pdoUser->getUserHash(), $this->hash);
		$this->assertEquals($pdoUser->getUserLastName(), $this->VALID_LASTNAME);
		$this->assertEquals($pdoUser->getUserSalt(), $this->salt);
		$this->assertEquals($pdoUser->getUserUsername(), $this->VALID_USERUSERNAME);
	}
	/**
	 * test grabbing a User that does not exist
	 */
	public function testGetInvalidUserByUserId() {
		// grab a user id that exceeds the maximum allowable user id
		$user = User::getUserByUserId($this->getPDO(), BrewCrewTest::INVALID_KEY);
		$this->assertNull($user);
	}
	/**
	//	 * test grabbing a User by email
	//	 **/
	public function testGetValidUserByUserEmail() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		// get user by user email and  insert to into mySQL
		$user = new User(null, $this->brewery->getBreweryId(), $this->VALID_ACCESSLEVEL,$this->VALID_ACTIVATIONTOKEN,$this->VALID_DATEOFBIRTH,$this->VALID_EMAIL, $this->VALID_FIRSTNAME, $this->hash, $this->VALID_LASTNAME, $this->salt, $this->VALID_USERUSERNAME);
		$user->insert($this->getPDO());

		/// grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserEmail($this->getPDO(), $user->getUserEmail());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));


		$this->assertEquals($pdoUser->getUserBreweryId(), $this->brewery->getBreweryId());
		$this->assertEquals($pdoUser->getUserAccessLevel(), $this->VALID_ACCESSLEVEL);
		$this->assertEquals($pdoUser->getUserActivationToken(),$this->VALID_ACTIVATIONTOKEN);
		$this->assertEquals($pdoUser->getUserDateOfBirth()->format("Y-m-d"),$this->VALID_DATEOFBIRTH);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoUser->getUserFirstName(), $this->VALID_FIRSTNAME);
		$this->assertEquals($pdoUser->getUserHash(), $this->hash);
		$this->assertEquals($pdoUser->getUserLastName(), $this->VALID_LASTNAME);
		$this->assertEquals($pdoUser->getUserSalt(), $this->salt);
		$this->assertEquals($pdoUser->getUserUsername(), $this->VALID_USERUSERNAME);
	}

	public function testGetValidUserByUserBreweryId(){
		$numRows = $this->getConnection()->getRowCount("user");
		// create a new User and insert to into mySQL
		$user = new User(null,$this->brewery->getBreweryId(), $this->VALID_ACCESSLEVEL,$this->VALID_ACTIVATIONTOKEN,$this->VALID_DATEOFBIRTH,$this->VALID_EMAIL, $this->VALID_FIRSTNAME, $this->hash, $this->VALID_LASTNAME, $this->salt, $this->VALID_USERUSERNAME);
		$user->insert($this->getPDO());

		/// grab the data from mySQL and enforce the fields match our expectations
		$results = User::getUserByUserBreweryId($this->getPDO(), $user->getUserBreweryId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\BrewCrew\\User", $results);



		//grab the result from the array and validate it
		$pdoUser = $results[0];
		$this->assertEquals($pdoUser->getUserBreweryId(),$this->brewery->getBreweryId());
		$this->assertEquals($pdoUser->getUserAccessLevel(), $this->VALID_ACCESSLEVEL);
		$this->assertEquals($pdoUser->getUserActivationToken(),$this->VALID_ACTIVATIONTOKEN);
		$this->assertEquals($pdoUser->getUserDateOfBirth()->format("Y-m-d"),$this->VALID_DATEOFBIRTH);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoUser->getUserFirstName(), $this->VALID_FIRSTNAME);
		$this->assertEquals($pdoUser->getUserHash(), $this->hash);
		$this->assertEquals($pdoUser->getUserLastName(), $this->VALID_LASTNAME);
		$this->assertEquals($pdoUser->getUserSalt(), $this->salt);
		$this->assertEquals($pdoUser->getUserUsername(), $this->VALID_USERUSERNAME);

	}
	public function testGetValidUserByUserAccessLevel(){
		$numRows = $this->getConnection()->getRowCount("user");
		// get User by Access level
		$user = new User(null,$this->brewery->getBreweryId(), $this->VALID_ACCESSLEVEL,$this->VALID_ACTIVATIONTOKEN,$this->VALID_DATEOFBIRTH,$this->VALID_EMAIL, $this->VALID_FIRSTNAME, $this->hash, $this->VALID_LASTNAME, $this->salt, $this->VALID_USERUSERNAME);
		$user->insert($this->getPDO());

		/// grab the data from mySQL and enforce the fields match our expectations
		$results = User::getUserByUserAccessLevel($this->getPDO(), $user->getUserAccessLevel());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\BrewCrew\\User", $results);


		//grab the result from the array and validate it
		$pdoUser = $results[0];
		$this->assertEquals($pdoUser->getUserBreweryId(),$this->brewery->getBreweryId());
		$this->assertEquals($pdoUser->getUserAccessLevel(), $this->VALID_ACCESSLEVEL);
		$this->assertEquals($pdoUser->getUserActivationToken(),$this->VALID_ACTIVATIONTOKEN);
		$this->assertEquals($pdoUser->getUserDateOfBirth()->format("Y-m-d"),$this->VALID_DATEOFBIRTH);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoUser->getUserFirstName(), $this->VALID_FIRSTNAME);
		$this->assertEquals($pdoUser->getUserHash(), $this->hash);
		$this->assertEquals($pdoUser->getUserLastName(), $this->VALID_LASTNAME);
		$this->assertEquals($pdoUser->getUserSalt(), $this->salt);
		$this->assertEquals($pdoUser->getUserUsername(), $this->VALID_USERUSERNAME);

	}
	/**
	//	 * test grabbing a User by username
	//	 **/
	public function testGetValidUserByUserUsername() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		// get user by userUsername
		$user = new User(null, $this->brewery->getBreweryId(), $this->VALID_ACCESSLEVEL,$this->VALID_ACTIVATIONTOKEN,$this->VALID_DATEOFBIRTH,$this->VALID_EMAIL, $this->VALID_FIRSTNAME, $this->hash, $this->VALID_LASTNAME, $this->salt, $this->VALID_USERUSERNAME);
		$user->insert($this->getPDO());

		/// grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserUsername($this->getPDO(), $user->getUserUsername());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));

		//grab the result from the array and validate it
		$this->assertEquals($pdoUser->getUserBreweryId(), $this->brewery->getBreweryId());
		$this->assertEquals($pdoUser->getUserAccessLevel(), $this->VALID_ACCESSLEVEL);
		$this->assertEquals($pdoUser->getUserActivationToken(),$this->VALID_ACTIVATIONTOKEN);
		$this->assertEquals($pdoUser->getUserDateOfBirth()->format("Y-m-d"),$this->VALID_DATEOFBIRTH);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoUser->getUserFirstName(), $this->VALID_FIRSTNAME);
		$this->assertEquals($pdoUser->getUserHash(), $this->hash);
		$this->assertEquals($pdoUser->getUserLastName(), $this->VALID_LASTNAME);
		$this->assertEquals($pdoUser->getUserSalt(), $this->salt);
		$this->assertEquals($pdoUser->getUserUsername(), $this->VALID_USERUSERNAME);
	}



}
