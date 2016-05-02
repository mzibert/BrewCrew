<?php

namespace Edu\Cnm\Agraham14\BrewCrew;
require_once("autoload.php");

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
	public function getUserId() {
		return($this->userId);
	}
	/**
	 * mutator method for user id
	 *
	 * @param int|null $newUserId new value of user id
	 * @throws \RangeException if $newUserId is not positive
	 * @throws \TypeError if $newUserId is not an integer
	 **/
	public function setUserId(int $newUserId = null) {
		// base case: if the user id is null, this a new tweet without a mySQL assigned id (yet)
		if($newUserId === null) {
			$this->userId = null;
			return;
		}

		// verify the tweet id is positive
		if($newUserId <= 0) {
			throw(new \RangeException("user id must a positive number."));
		}

		// convert and store the user id
		$this->userId = $newUserId;
	}
}
