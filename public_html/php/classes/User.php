<?php

namespace Edu\Cnm\Agraham14\BrewCrew;
require_once("autoload.php");
header("Location: ..", true, 301);

class User implements \JsonSerializable {
	use ValidateDate;
	/**
	 * id for the User is the primary key
	 * @var int $userId
	 */
	private $userId;
	/**
	 * id for this userBreweryId; this is the foreign key
	 * @var int $userBreweryId
	 **/
	private $userBreweryId;
	/**
	 * name of media
	 * @var int $userAccessLevel
	 */
	private $userAccessLevel;
	/**
	 * name of userActivationToken
	 * @var int $userActivationToken
	 */
	private $userActivationToken;
	/**
	 * name of userDateOfBirth
	 * @var \DateTime $userDateOfBirth
	 */
	private $userDateOfBirth;
	/**
	 * name of userFirstName
	 * @var string $userFirstName
	 */
	private $userFirstName;
	/**
	 * name of userLastName
	 * @var string $userLastName
	 */
	private $userLastName;
	/**
	 * name of userEmail
	 * @var string $userEmail
	 */
	private $userEmail;
	/**
	 * name of username
	 * @var string $username
	 */
	private $username;
	/**
	 * name of userHash
	 * @var string $userHash
	 */
	private $userHash;
	/**
	 * name of userSalt
	 * @var string $userSalt
	 */
	private $userSalt;

	/**
	 * constructor for User      *
	 * @param int|null $newUserId id of this User or null if a new User
	 * @param int $newUserBreweryId int id of the Brewery
	 * @param int $newUserAccessLevel
	 * @param int $newUserActivationToken int with user token
	 * @param \DateTime|string|null $newUserDateOfBirth date User was sent or null if set to current date and time
	 * @param string $newUserFirstName string containing actual user first name
	 * @param string $newUserLastName string containing actual user LAST NAME
	 * @param string $newUserEmail string containing user email
	 * @param string $newUsername string containing actual user name
	 * @param string $newUserHash string containing actual user password hash
	 * @param string $newUserSalt string containing actual user password salt
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long,
	 * negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct (int $newUserId = null, int $newUserBreweryId, int $newUserAccessLevel, int $newUserActivationToken, $newUserDateOfBirth = null, string $newUserFirstName, string $newUserLastName, string $newUserEmail, string $newUsername, string $newUserHash, string $newUserSalt) {
		try {
			$this->setUserId($newUserId);
			$this->setUserBreweryId($newUserBreweryId);
			$this->setUserAccessLevel($newUserAccessLevel);
			$this->setUserActivationToken($newUserActivationToken);
			$this->setUserDateOfBirth($newUserDateOfBirth);
			$this->setUserFirstName($newUserFirstName);
			$this->setUserLastName($newUserLastName);
			$this->setUserEmail($newUserEmail);
			$this->setUsername($newUsername);
			$this->setUserHash($newUserHash);
			$this->setUserSalt($newUserSalt);
		} catch(\InvalidArgumentException $invalidArgument) {
			// rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			// rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			// rethrow the exception to the caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			// rethrow the exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for user id
	 *
	 * @return int|null value of user id
	 **/
	public function getUserId () {
		return ($this->userId);
	}

	/**
	 * mutator method for user id
	 *
	 * @param int|null $newUserId new value of user id
	 * @throws \RangeException if $newUserId is not positive
	 * @throws \TypeError if $newUserId is not an integer
	 **/
	public function setUserId (int $newUserId = null) {
		// base case: if the user id is null, this a new user without a mySQL assigned id (yet)
		if($newUserId === null) {
			$this->userId = null;
			return;
		}

		// verify the user id is positive
		if($newUserId <= 0) {
			throw(new \RangeException("user id must a positive number."));
		}

		// convert and store the user id
		$this->userId = $newUserId;
	}

	/**
	 * accessor method for User Brewery Id
	 *
	 * @return int|null value of user brewery id
	 **/
	public function getUserBreweryId () {
		return ($this->userBreweryId);
	}

	/**
	 * mutator method for user brewery id
	 *
	 * @param int|null $newUserBreweryId new value of user brewery id
	 * @throws \RangeException if $newUserBreweryId is not positive
	 * @throws \TypeError if $newUserBreweryId is not an integer
	 **/
	public function setUserBreweryId (int $newUserBreweryId = null) {

		if($newUserBreweryId === null) {
			$this->userBreweryId = null;
			return;
		}

		// verify the user brewery id is positive
		if($newUserBreweryId <= 0) {
			throw(new \RangeException("user brewery id must a positive number."));
		}

		// convert and store the user brewery id
		$this->userBreweryId = $newUserBreweryId;
	}
	/**
	 * accessor method for user AccessLevel
	 *
	 * @return int|null value of user Access Level
	 **/
	public function getUserAccessLevel () {
		return ($this->userAccessLevel);
	}

	/**
	 * mutator method for userAccessLevel
	 *
	 * @param int|null $userAccessLevel new value of user id
	 * @throws \RangeException if $userAccessLevel is not positive
	 * @throws \TypeError if $userAccessLevel is not an integer
	 **/
	public function setUserAccessLevel (int $userAccessLevel = null) {

		if($userAccessLevel === null) {
			$this->userAccessLevel = null;
			return;
		}
	}
	/**
	 * accessor method for userDateOfBirth date
	 *
	 * @return \DateTime value of userDateOfBirth date
	 **/
	public function getUserDateOfBirth() {
		return($this->userDateOfBirth);
	}

	/**
	 * mutator method for userDateOfBirth date
	 *
	 * @param \DateTime|string|null $newUserDateOfBirth user DateOfBirth date as a DateTime object or string
	 * @throws \InvalidArgumentException if $newUserDateOfBirth is not a valid object or string
	 * @throws \RangeException if $newUserDateOfBirth is a date that does not exist
	 **/
	public function setUserDateOfBirth($newUserDateOfBirth = null) {
		// base case: if the date is null, ask user to enter date of birth
		if($newUserDateOfBirth === null) {
			throw (new \RangeException("You must enter your date of birth"));
		}
			if($newUserDateOfBirth < $newUserDateOfBirth.getdate()){
			throw (new \RangeException("You are too young."));
			}
		// store the userDateOfBirth date
		try {
			$newUserDateOfBirth = $this->validateDate($newUserDateOfBirth);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}
		$this->userDateOfBirth = $newUserDateOfBirth;

	}

	/**
	 * accessor method for userActivationToken
	* @return int|null value of userActivationToken
	 **/
	public function getUserActivationToken() {
		return($this->userActivationToken);
	}
	/**
	 * mutator method for userActivationToken id
	 *
	 * @param int|null $newUserActivationToken new value of userActivationToken
	 * @throws \RangeException if $newUserActivationToken is not positive
	 * @throws \TypeError if $newUserActivationToken is not an integer
	 **/
	public function setUserActivationToken(int $newUserActivationToken = null) {
		// base case: if the userActivationToken id is null, this a new userActivationToken without a mySQL assigned id (yet)
		if($newUserActivationToken === null) {
			$this->userActivationTokenId = null;
			return;
		}

		// verify the userActivationToken id is positive
		if($newUserActivationToken <= 0) {
			throw(new \RangeException("UserActivationToken must a positive number."));
		}

		// convert and store the userActivationToken
		$this->userActivationToken = $newUserActivationToken;
	}
	/**
	 * accessor method for userFirstName
	 * @return string value of userFirstName
	 **/
	public function getUserFirstName() {
		return($this->userFirstName);
	}
	/**
	 * mutator method for UserFirstName
	 *
	 * @param string $newUserFirstName new value of UserFirstName
	 * @throws \InvalidArgumentException if $newUserFirstNameis not a string or insecure
	 * @throws \RangeException if $newUserFirstName is > 32 characters
	 * @throws \TypeError if $newUserFirstName is not a string
	 **/
	public function setUserFirstName(string $newUserFirstName) {
		// verify the User's First Name content is secure
		$newUserFirstName = trim($newUserFirstName);
		$newUserFirstName = filter_var($newUserFirstName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newUserFirstName) === true) {
			throw(new \InvalidArgumentException("User First Name content is empty or insecure"));
		}

		// verify the first name content will fit in the database
		if(strlen($newUserFirstName) > 32) {
			throw(new \RangeException("First name content too large"));
		}

		// store the user's first name
		$this->userFirstName = $newUserFirstName;
	}
	/**
	 * accessor method for userLastName
	 * @return string value of userLastName
	 **/
	public function getUserLastName() {
		return($this->userLastName);
	}
	/**
	 * mutator method for UserLastName
	 *
	 * @param string $newUserLastName new value of UserLastName
	 * @throws \InvalidArgumentException if $newUserLastNamei s not a string or insecure
	 * @throws \RangeException if $newUserLastName is > 32 characters
	 * @throws \TypeError if $newUserLastName is not a string
	 **/
	public function setUserLastName(string $newUserLastName) {
		// verify the User's Last Name content is secure
		$newUserLastName = trim($newUserLastName);
		$newUserLastName = filter_var($newUserLastName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newUserLastName) === true) {
			throw(new \InvalidArgumentException("User Last Name content is empty or insecure"));
		}

		// verify the last name content will fit in the database
		if(strlen($newUserLastName) > 32) {
			throw(new \RangeException("Last name content too large"));
		}

		// store the user's last name
		$this->userLastName = $newUserLastName;
	}
	/**
	 * accessor method for UserEmail
	 * @return string value of UserEmail
	 **/
	public function getUserEmail() {
		return($this->userEmail);
	}
	/**
	 * mutator method for UserEmail
	 *
	 * @param string $newUserEmail new value of userEmail
	 * @throws \InvalidArgumentException if $newUserEmaili s not a string or insecure
	 * @throws \RangeException if $newUserEmail is > 128 characters
	 * @throws \TypeError if $newUserEmail is not a string
	 **/
	public function setUserEmail(string $newUserEmail) {
		// verify the User's email content is secure
		$newUserEmail = trim($newUserEmail);
		$newUserEmail = filter_var($newUserEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newUserEmail) === true) {
			throw(new \InvalidArgumentException("User's email content is empty or insecure"));
		}

		// verify the email will fit in the database
		if(strlen($newUserEmail) > 128) {
			throw(new \RangeException("Email too large"));
		}

		// store the user's email
		$this->UserEmail = $newUserEmail;
	}
	/**
	 * accessor method for username
	 * @return string value of username
	 **/
	public function getUsername() {
		return($this->username);
	}
	/**
	 * mutator method for username
	 *
	 * @param string $newUsername new value of username
	 * @throws \InvalidArgumentException if $newUsername is not a string or insecure
	 * @throws \RangeException if $newUsername is > 32 characters
	 * @throws \TypeError if $newUsername is not a string
	 **/
	public function setUsername(string $newUsername) {
		// verify the User's username is secure
		$newUsername = trim($newUsername);
		$newUsername = filter_var($newUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newUsername) === true) {
			throw(new \InvalidArgumentException("Username is empty or insecure"));
		}

		// verify the username will fit in the database
		if(strlen($newUsername) > 32) {
			throw(new \RangeException("Username too large"));
		}

		// store the user's username
		$this->username = $newUsername;
	}
	/**
	 * accessor method for userHash
	 * @return string value of userHash
	 **/
	public function getUserHash() {
		return($this->userHash);
	}
	/**
	 * mutator method for userHash
	 *
	 * @param string $newUserHash new value of userHash
	 * @throws \InvalidArgumentException if $newUserHash is not a string or insecure
	 * @throws \RangeException if $newUserHash is > 64 characters
	 * @throws \TypeError if $newUserHash is not a string
	 **/
	public function setUserHash(string $newUserHash) {
		// verify the User's password hash is secure
		$newUserHash = trim($newUserHash);
		$newUserHash = filter_var($newUserHash, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newUserHash) === true) {
			throw(new \InvalidArgumentException("User's password hash is empty or insecure"));
		}

		// verify the hash will fit in the database
		if(strlen($newUserHash) > 64) {
			throw(new \RangeException("Hash too large"));
		}

		// store the userHash
		$this->userHash = $newUserHash;
	}
	/**
	 * accessor method for userSalt
	 * @return string value of userSalt
	 **/
	public function getUserSalt() {
		return($this->userSalt);
	}
	/**
	 * mutator method for userSalt
	 *
	 * @param string $newUserSalt new value of userSalt
	 * @throws \InvalidArgumentException if $newUserSalt is not a string or insecure
	 * @throws \RangeException if $newUserSalt is > 64 characters
	 * @throws \TypeError if $newUserSalt is not a string
	 **/
	public function setUserSalt(string $newUserSalt) {
		// verify the User's password salt is secure
		$newUserSalt = trim($newUserSalt);
		$newUserSalt = filter_var($newUserSalt, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newUserSalt) === true) {
			throw(new \InvalidArgumentException("User's password salt is empty or insecure"));
		}

		// verify the salt will fit in the database
		if(strlen($newUserSalt) > 64) {
			throw(new \RangeException("Salt too large"));
		}

		// store the userSalt
		$this->userSalt = $newUserSalt;
	}
}
