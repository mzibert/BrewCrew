<?php

namespace Edu\Cnm\BrewCrew;

use Edu\Cnm\BrewCrew\ValidateDate;

require_once("autoload.php");


class User implements \JsonSerializable {
	use ValidateDate;
	/**
	 * id for the User is the primary key
	 * @var int $userId
	 **/
	private $userId;
	/**
	 * id for this userBreweryId; this is the foreign key
	 * @var int $userBreweryId
	 **/
	private $userBreweryId;
	/**
	 * user access level of 1 or 2
	 * @var int $userAccessLevel
	 **/
	private $userAccessLevel;
	/**
	 *user activation token hex
	 * @var string $userActivationToken
	 **/
	private $userActivationToken;
	/**
	 * birth date of user
	 * @var \DateTime $userDateOfBirth
	 **/
	private $userDateOfBirth;
	/**
	 * email of user
	 * @var string $userEmail
	 **/
	private $userEmail;
	/**
	 * first name of user
	 * @var string $userFirstName
	 **/
	private $userFirstName;
	/**
	 * name of userHash
	 * @var string $userHash
	 **/
	private $userHash;
	/**
	 * last name of user
	 * @var string $userLastName
	 **/
	private $userLastName;
	/**
	 * name of userSalt
	 * @var string $userSalt
	 **/
	private $userSalt;
	/**
	 * username of user
	 * @var string $userUsername
	 **/
	private $userUsername;

	/**
	 * constructor for User      *
	 * @param int|null $newUserId id of this User or null if a new User
	 * @param int $newUserBreweryId int id of the Brewery
	 * @param int $newUserAccessLevel
	 * @param string $newUserActivationToken string with user token
	 * @param \DateTime $newUserDateOfBirth date User was sent or set to current date and time
	 * @param string $newUserEmail string containing user email
	 * @param string $newUserFirstName string containing actual user first name
	 * @param string $newUserHash string containing actual user password hash
	 * @param string $newUserLastName string containing actual user LAST NAME
	 * @param string $newUserSalt string containing actual user password salt
	 * @param string $newUserUsername string containing actual user name
	 * @throws \Exception if some other exception occurs
	 * @throws \TypeError if data types violate type hints
	 **/
	public function __construct (int $newUserId = null, int $newUserBreweryId = null, int $newUserAccessLevel, string $newUserActivationToken = null, $newUserDateOfBirth, string $newUserEmail, string $newUserFirstName, string $newUserHash, string $newUserLastName, string $newUserSalt, string $newUserUsername) {
		try {
			$this->setUserId($newUserId);
			$this->setUserBreweryId($newUserBreweryId);
			$this->setUserAccessLevel($newUserAccessLevel);
			$this->setUserActivationToken($newUserActivationToken);
			$this->setUserDateOfBirth($newUserDateOfBirth);
			$this->setUserFirstName($newUserFirstName);
			$this->setUserEmail($newUserEmail);
			$this->setUserHash($newUserHash);
			$this->setUserLastName($newUserLastName);
			$this->setUserSalt($newUserSalt);
			$this->setUserUsername($newUserUsername);
		} catch(\InvalidArgumentException $invalidArgument) {
			//rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			//rethrow exception to caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			//rethrow the exception to the caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			//rethrow regular exception to caller
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
		$this->userId = intval($newUserId);
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
		$this->userBreweryId = intval($newUserBreweryId);
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
	 * @throws \InvalidArgumentException if $userAccessLevel cannot be null
	 **/
	public function setUserAccessLevel (int $userAccessLevel) {
		
		//make sure user access level= 1 or 0
		if(($userAccessLevel !== 0) && ($userAccessLevel !== 1)) {
			throw(new\RangeException("user access level has to be 0 or 1"));
		}
		//convert and store  user access level
		$this->userAccessLevel = $userAccessLevel;
	}
	public function getUserActivationToken(){
		return($this->userActivationToken);
	}
	/**
	 * mutator method for userActivationToken
	 *
	 * @param string $newUserActivationToken
	 * @throws \InvalidArgumentException if $newUserActivationToken is not a string or insecure
	 * @throws \TypeError if $newUserActivationToken is not a string
	 **/
	public function setUserActivationToken (string $newUserActivationToken = null) {
		// verify the User's Activation Token is secure

		if($newUserActivationToken === null){
			$this->userActivationToken = null;
			return;
		}

		$newUserActivationToken = strtolower(trim($newUserActivationToken));
		if(ctype_xdigit($newUserActivationToken) === false) {
			throw(new\RangeException("user activation token cannot be null"));
		}
//make sure user activation token=32
		if(strlen($newUserActivationToken) !== 32) {
			throw(new\RangeException("user activation token has to be 32"));
		}

		$this->userActivationToken = $newUserActivationToken;
	}

	/**
	 * accessor method for userDateOfBirth date
	 *
	 * @return  \DateTime  value of userDateOfBirth date
	 **/
	public function getUserDateOfBirth () {
		return ($this->userDateOfBirth);
	}

	/**
	 * mutator method for userDateOfBirth date
	 *
	 * @param  \DateTime $newUserDateOfBirth user DateOfBirth date as a DateTime object o
	 * @throws \OutOfRangeException if $newUserDateOfBirth is < 21
	 **/
	public function setUserDateOfBirth ($newUserDateOfBirth = null) {
		// base case: if the date is null, ask user to enter date of birth
		if($newUserDateOfBirth === null) {
			throw (new \OutOfBoundsException("You must enter your date of birth"));
		}

		$newUserDateOfBirth = self::validateDate($newUserDateOfBirth);
		$drinkDate = new \DateTime();
		$drinkDate = $drinkDate->sub(new \DateInterval('P21Y'));
		if($drinkDate < $newUserDateOfBirth) {
			throw (new \OutOfRangeException("You are too young."));
		}
		// store the userDateOfBirth date
		$this->userDateOfBirth = $newUserDateOfBirth;

	}

	/**
	 * accessor method for UserEmail
	 * @return string value of UserEmail
	 **/
	public function getUserEmail () {
		return ($this->userEmail);
	}

	/**
	 * mutator method for UserEmail
	 *
	 * @param string $newUserEmail new value of userEmail
	 * @throws \InvalidArgumentException if $newUserEmaili s not a string or insecure
	 * @throws \RangeException if $newUserEmail is > 128 characters
	 * @throws \TypeError if $newUserEmail is not a string
	 **/
	public function setUserEmail (string $newUserEmail) {
		// verify the User's email content is secure
		$newUserEmail = trim($newUserEmail);
		$newUserEmail = filter_var($newUserEmail, FILTER_SANITIZE_EMAIL);
		if(empty($newUserEmail) === true) {
			throw(new \InvalidArgumentException("User's email content is empty or insecure"));
		}

		// verify the email will fit in the database
		if(strlen($newUserEmail) > 128) {
			throw(new \RangeException("Email too large"));
		}

		// store the user's email
		$this->userEmail = $newUserEmail;
	}


	/**
	 * accessor method for userFirstName
	 * @return string value of userFirstName
	 **/
	public function getUserFirstName () {
		return ($this->userFirstName);
	}

	/**
	 * mutator method for UserFirstName
	 *
	 * @param string $newUserFirstName new value of UserFirstName
	 * @throws \InvalidArgumentException if $newUserFirstNameis not a string or insecure
	 * @throws \RangeException if $newUserFirstName is > 32 characters
	 * @throws \TypeError if $newUserFirstName is not a string
	 **/
	public function setUserFirstName (string $newUserFirstName) {
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
	 * accessor method for user hash
	 *
	 * @return int|null for $newUserHash
	 **/
	public function getUserHash () {
		return ($this->userHash);
	}

	/**
	 * mutator method for user hash
	 * @param string $newUserHash string of user hash
	 * @param \InvalidArgumentException if $newUserHash is not a string
	 * @param \RangeException if $newUserHash = 128
	 * @param \TypeError if $newUserHash is not a string
	 **/
	public function setUserHash (string $newUserHash) {
		//verification that $userHash is secure
		$newUserHash = strtolower(trim($newUserHash));
		//make sure that user hash cannot be null
		if(ctype_xdigit($newUserHash) === false) {
			throw(new \RangeException("user hash cannot be null"));
		}
		//make sure user hash =  128
		if(strlen($newUserHash) !== 128) {
			throw(new \RangeException("user hash has to be 128"));
		}
		//convert and store user hash
		$this->userHash = $newUserHash;
	}

	/**
	 * accessor method for userLastName
	 * @return string value of userLastName
	 **/
	public function getUserLastName () {
		return ($this->userLastName);
	}

	/**
	 * mutator method for UserLastName
	 *
	 * @param string $newUserLastName new value of UserLastName
	 * @throws \InvalidArgumentException if $newUserLastNamei s not a string or insecure
	 * @throws \RangeException if $newUserLastName is > 32 characters
	 * @throws \TypeError if $newUserLastName is not a string
	 **/
	public function setUserLastName (string $newUserLastName) {
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
	 * accessor method for userSalt
	 * @return string value of userSalt
	 **/
	public function getUserSalt () {
		return ($this->userSalt);
	}

	/**
	 * mutator method for userSalt
	 *
	 * @param string $newUserSalt new value of userSalt
	 * @throws \InvalidArgumentException if $newUserSalt is not a string or insecure
	 * @throws \RangeException if $newUserSalt is > 64 characters
	 * @throws \TypeError if $newUserSalt is not a string
	 **/
	public function setUserSalt (string $newUserSalt) {
		$newUserSalt = strtolower(trim($newUserSalt));
//verification that $userSalt is secure
		if(ctype_xdigit($newUserSalt) === false) {
			throw(new\RangeException("user salt cannot be null"));
		}
//make sure user salt=64
		if(strlen($newUserSalt) !== 64) {
			throw(new\RangeException("user hash has to be 64"));
		}
//convert and store user salt
		$this->userSalt = $newUserSalt;
	}


	/**
	 * accessor method for username
	 * @return string value of username
	 **/
	public function getUserUsername () {
		return ($this->userUsername);
	}

	/**
	 * mutator method for username
	 *
	 * @param string $newUserUsername new value of userUsername
	 * @throws \InvalidArgumentException if $newUsername is not a string or insecure
	 * @throws \RangeException if $newUsername is > 32 characters
	 * @throws \TypeError if $newUsername is not a string
	 **/
	public function setUserUsername (string $newUserUsername) {
		// verify the User's username is secure
		$newUserUsername = trim($newUserUsername);
		$newUserUsername = filter_var($newUserUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newUserUsername) === true) {
			throw(new \InvalidArgumentException("Username is empty or insecure"));
		}

		// verify the username will fit in the database
		if(strlen($newUserUsername) > 32) {
			throw(new \RangeException("Username too large"));
		}

		// store the user's username
		$this->userUsername = $newUserUsername;
	}


	/**
	 * inserts this User into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert (\PDO $pdo) {
// enforce the userId is null (i.e., don't insert a user that already exists)
		if($this->userId !== null) {
			throw(new \PDOException("not a new user"));
		}

// create query template
		$query = "INSERT INTO user(userBreweryId,userAccessLevel, userActivationToken, userDateOfBirth,userEmail,userFirstName,userHash, userLastName, userSalt, userUsername) VALUES(:userBreweryId, :userAccessLevel, :userActivationToken, :userDateOfBirth, :userEmail, :userFirstName, :userHash, :userLastName, :userSalt, :userUsername)";
		$statement = $pdo->prepare($query);

// bind the member variables to the place holders in the template

		$parameters = ["userBreweryId" => $this->userBreweryId,
			"userAccessLevel" => $this->userAccessLevel,
			"userActivationToken" => $this->userActivationToken,
			"userDateOfBirth" => $this->userDateOfBirth->format("Y-m-d"),
			"userEmail" => $this->userEmail,
			"userFirstName" => $this->userFirstName,
			"userHash" => $this->userHash,
			"userLastName" => $this->userLastName,
			"userSalt" => $this->userSalt,
			"userUsername" => $this->userUsername];
		$statement->execute($parameters);

// update the null userId with what mySQL just gave us
		$this->userId = intval($pdo->lastInsertId());
	}


	/**
	 * deletes the user from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param \PDOException when mySQL related errors occur
	 * @param \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete (\PDO $pdo) {
		//enforce the the userId is not null (tldr don't delete a user that is not yet inserted)
		if($this->userId === null) {
			throw(new \PDOException("unable to delete a user that does not exist"));
		}
		//create query template
		$query = "DELETE FROM user WHERE userId = :userId";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holder in the template
		$parameters = ["userId" => $this->userId];
		$statement->execute($parameters);
	}

	/**
	 * updates this User in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update (\PDO $pdo) {
// enforce the userId is not null (i.e., don't update a user that hasn't been inserted)
		if($this->userId === null) {
			throw(new \PDOException("unable to update a user that does not exist"));
		}

// create query template
		$query = "UPDATE user SET userBreweryId = :userBreweryId, userAccessLevel = :userAccessLevel,
						userActivationToken = :userActivationToken, userDateOfBirth = :userDateOfBirth, userEmail = :userEmail,
						userFirstName = :userFirstName, userHash = :userHash, userLastName = :userLastName, userSalt =:userSalt,
						userUsername =:userUsername WHERE userId = :userId";
		$statement = $pdo->prepare($query);

		$dob = $this->userDateOfBirth->format("Y-m-d");
		$parameters = ["userBreweryId" => $this->userBreweryId, "userAccessLevel" => $this->userAccessLevel, "userActivationToken" => $this->userActivationToken,
			"userDateOfBirth" => $dob, "userEmail" => $this->userEmail,
			"userFirstName" => $this->userFirstName, "userHash" => $this->userHash,
			"userLastName" => $this->userLastName, "userSalt" => $this->userSalt,
			"userUsername" => $this->userUsername, "userId" => $this->userId];

		$statement->execute($parameters);
	}

	/**
	 * gets the user by userId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $userId user id to search for
	 * @return user|null user found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getUserByUserId (\PDO $pdo, int $userId) {
		// sanitize the user id before searching
		if($userId <= 0) {
			throw(new \PDOException("user id is not positive"));
		}
		// create query template
		$query = "SELECT userId, userBreweryId, userAccessLevel, userActivationToken, userDateOfBirth,userEmail, userFirstName, userHash, userLastName, userSalt, userUsername
			FROM user
			WHERE userId
			= :userId";

		$statement = $pdo->prepare($query);

		// bind the user id to the place holder in the template

		$parameters = array("userId" => $userId);
		$statement->execute($parameters);

		// grab the user from mySQL
		try {
			$user = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false)
				$user = new User($row["userId"], $row["userBreweryId"], $row["userAccessLevel"], $row["userActivationToken"], $row["userDateOfBirth"], $row["userEmail"], $row["userFirstName"], $row["userHash"], $row["userLastName"], $row["userSalt"], $row["userUsername"]);
		} catch(\Exception $exception) {
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($user);
	}

	/**
	 * gets user by userBreweryId
	 * @param int $userBreweryId
	 * @param \PDO object $pdo
	 * @return \SplFixedArray SplFixedArray of users by user brewery id found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getUserByUserBreweryId (\PDO $pdo, int $userBreweryId) {
		// sanitize the description before searching
		$userBreweryId = trim($userBreweryId);
		$userBreweryId = filter_var($userBreweryId, FILTER_VALIDATE_INT, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($userBreweryId) === true) {
			throw(new \PDOException("user brewery id is invalid"));
		}
		// create query template
		$query = "SELECT userId, userBreweryId, userAccessLevel, userActivationToken, userDateOfBirth, userEmail, userFirstName, userHash, userLastName, userSalt, userUsername FROM user WHERE userBreweryId = :userBreweryId";
		$statement = $pdo->prepare($query);

		//bind the userBreweryID to the place holder in the template
		$parameters = array("userBreweryId" => $userBreweryId);
		$statement->execute($parameters);

		// build an array of users
		$users = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$user = new User($row["userId"], $row["userBreweryId"], $row["userAccessLevel"], $row["userActivationToken"], $row["userDateOfBirth"], $row["userEmail"], $row["userFirstName"], $row["userHash"], $row["userLastName"], $row["userSalt"], $row["userUsername"]);
				$users[$users->key()] = $user;
				$users->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($users);
	}

	/**
	 * gets user by userAccessLevel
	 *
	 * @param int $userAccessLevel
	 * @param \PDO object $pdo
	 * @return \SplFixedArray SplFixedArray of users found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getUserByUserAccessLevel (\PDO $pdo, int $userAccessLevel) {
		// sanitize the description before searching
		$userAccessLevel = trim($userAccessLevel);
		$userAccessLevel = filter_var($userAccessLevel, FILTER_VALIDATE_INT);
		if(empty($userAccessLevel) === true) {
			throw(new \PDOException("user access level is invalid"));
		}
		// create query template
		$query = "SELECT userId, userBreweryId, userAccessLevel, userActivationToken, userDateOfBirth,userEmail, userFirstName, userHash, userLastName, userSalt, userUsername FROM user WHERE userAccessLevel = :userAccessLevel";
		$statement = $pdo->prepare($query);

		//bind the user access level to the place holder in the template
		$parameters = array("userAccessLevel" => $userAccessLevel);
		$statement->execute($parameters);

		// build an array of users
		$users = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$user = new User($row["userId"], $row["userBreweryId"], $row["userAccessLevel"], $row["userActivationToken"], $row["userDateOfBirth"], $row["userEmail"], $row["userFirstName"], $row["userHash"], $row["userLastName"], $row["userSalt"], $row["userUsername"]);
				$users[$users->key()] = $user;
				$users->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($users);
	}

	/**
	 * gets user by userActivationToken
	 *
	 * @param string $userActivationToken user batting to search for
	 * @param \PDO object $pdo
	 * @return User object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getUserByUserActivationToken (\PDO $pdo, string $userActivationToken) {

		// sanitize the description before searching
		$userActivationToken = trim($userActivationToken);
		$userActivationToken = filter_var($userActivationToken, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($userActivationToken) === true) {
			throw(new \PDOException("user activation token is invalid"));
		}
		// create query template
		$query = "SELECT userId, userBreweryId, userAccessLevel, userActivationToken, userDateOfBirth,userEmail, userFirstName, userHash, userLastName, userSalt, userUsername  FROM user WHERE userActivationToken = :userActivationToken";
		$statement = $pdo->prepare($query);

		//bind the user ActivationToken to the place holder in the template
		$parameters = array("userActivationToken" => $userActivationToken);
		$statement->execute($parameters);
		if($statement === false) {
			throw(new \PDOException("user activation token does not exist"));
		}

		// get single user
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		$row = $statement->fetch();
		try {
			$user = new User($row["userId"], $row["userBreweryId"], $row["userAccessLevel"], $row["userActivationToken"], $row["userDateOfBirth"], $row["userEmail"], $row["userFirstName"], $row["userHash"], $row["userLastName"], $row["userSalt"], $row["userUsername"]);
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		return ($user);
	}

	/**
	 * gets user by userEmail
	 *
	 * @param string $userEmail
	 * @param \PDO object $pdo
	 * @return User object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getUserByUserEmail (\PDO $pdo, string $userEmail) {
		// sanitize the description before searching
		$userEmail = trim($userEmail);
		$userEmail = filter_var($userEmail, FILTER_SANITIZE_STRING);
		if(empty($userEmail) === true) {
			throw(new \PDOException("user email is invalid"));
		}
		// create query template
		$query = "SELECT userId, userBreweryId, userAccessLevel, userActivationToken, userDateOfBirth, userEmail, userFirstName, userHash, userLastName, userSalt, userUsername FROM user WHERE userEmail = :userEmail";
		$statement = $pdo->prepare($query);

		//bind the user EMAIL to the place holder in the template

		$parameters = array("userEmail" => $userEmail);
		$statement->execute($parameters);
		try {
			$user = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$user = new User($row["userId"], $row["userBreweryId"], $row["userAccessLevel"], $row["userActivationToken"], $row["userDateOfBirth"], $row["userEmail"], $row["userFirstName"], $row["userHash"], $row["userLastName"], $row["userSalt"], $row["userUsername"]);
			}
		} catch(\Exception $exception) {
			//if row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($user);
	}

	/**
	 * gets user by userUsername
	 *
	 * @param string $userUsername
	 * @param \PDO object $pdo
	 * @return User object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getUserByUserUsername (\PDO $pdo, string $userUsername) {
		// sanitize the description before searching
		$userUsername = trim($userUsername);
		$userUsername = filter_var($userUsername, FILTER_SANITIZE_STRING);
		if(empty($userUsername) === true) {
			throw(new \PDOException("username is invalid"));
		}
		// create query template
		$query = "SELECT userId, userBreweryId, userAccessLevel, userActivationToken, userDateOfBirth, userEmail, userFirstName, userHash, userLastName, userSalt, userUsername FROM user WHERE userUsername = :userUsername";
		$statement = $pdo->prepare($query);

		//bind the username to the place holder in the template
		$parameters = array("userUsername" => $userUsername);
		$statement->execute($parameters);
		try {
			$user = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$user = new User($row["userId"], $row["userBreweryId"], $row["userAccessLevel"], $row["userActivationToken"], $row["userDateOfBirth"], $row["userEmail"], $row["userFirstName"], $row["userHash"], $row["userLastName"], $row["userSalt"], $row["userUsername"]);
			}
		} catch(\Exception $exception) {
			//if row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($user);
	}

	/**
	 * gets all Users
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Users found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllUsers (\PDO $pdo) {
		//create query template
		$query = "SELECT userId, userBreweryId, userAccessLevel, userActivationToken, userDateOfBirth, userEmail, userFirstName, userHash, userLastName, userSalt, userUsername FROM user";
		$statement = $pdo->prepare($query);
		$statement->execute();
		//build an array of users
		$users = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$user = $user = new User($row["userId"], $row["userBreweryId"], $row["userAccessLevel"], $row["userActivationToken"], $row["userDateOfBirth"], $row["userEmail"], $row["userFirstName"], $row["userHash"], $row["userLastName"], $row["userSalt"], $row["userUsername"]);
				$users[$users->key()] = $user;
				$users->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($users);
	}

	/**
	 * @return array
	 **/
	public function jsonSerialize () {
		$fields = get_object_vars($this);
		unset ($fields["userHash"]);
		unset($fields["userSalt"]);
		return ($fields);
	}
}
