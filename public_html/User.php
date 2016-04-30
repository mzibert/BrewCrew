<?php

namespace Edu\Cnm\Agraham14\Supernatural;
require_once("autoload.php");

class User implements \JsonSerializable {
	use ValidateDate;
	/**
	 * id for the User is the primary key
	 * @var int $userId
	 */
	private $userId;
	/**
	 * id for this UserBreweryId; this is the foreign key
	 * @var int $userBreweryId
	 **/
	private $userBreweryId;
	/**
	 * name of media
	 * @var int $userAccessLevel
	 */
	private $userAccessLevel;
	/**
	 * name of UserActivationToken
	 * @var int $userActivationToken
	 */
	private $userActivationToken;
	/**
	 * name of UserDateOfBirth
	 * @var date $userDateOfBirth
	 */
	private $userDateOfBirth;
	/**
	 * name of UserFirstName
	 * @var string $userFirstName
	 */
	private $userFirstName;
	/**
	 * name of UserLastName
	 * @var string $userLastName
	 */
	private $userLastName;
	/**
	 * name of UserEmail
	 * @var string $userEmail
	 */
	private $userEmail;
	/**
	 * name of Username
	 * @var string $username
	 */
	private $username;

}