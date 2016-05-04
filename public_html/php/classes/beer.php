<?php
namespace Edu\Cnm\mzibert\BrewCrew;

require_once("autoload.php");

class beer {
	/** Id for this beer is assigned by the system; this is the primary key.
	 * @var int $beerId
	 **/
	private $beerId;
	/** Id of the brewery that has this beer; this is the foreign key
	 * @var int $beerBreweryId
	 **/
	private $beerBreweryId;
	/** Actual percentage measurement for value of alcohol by volume
	 * @var float $beerAbv
	 **/
	private $beerAbv;
	/** text field provided by the API to inform if and when beer is available
	 * @var string $beerAvailability
	 **/
	private $beerAvailability;
	/** text field provided by the API to reflect any awards the beer has earned
	 * @var string $beerAwards
	 **/
	private $beerAwards;
	/** Decimal number created on a scale from 0 to 1 to reflect beer color on a scale from 0 being darkest to 1 being lightest
	 * @var float $beerColor
	 **/
	private $beerColor;
	/** string of open text taken from the API used to describe the beer
	 * @var string $beerDescription
	 **/
	private $beerDescription;
	/** string usually numbers used to evaluate the quantitative value designated to the measurement of bitterness in beer.  Lower values less bitter, higher values more bitter.  However, some brewery use creative text descriptions instead
	 * @var string $beerIbu
	 **/
	private $beerIbu;
	/** string of open text for the name of the beer
	 * @var string $beerName
	 **/
	private $beerName;
	/** string used to capture the industry standard style label of the beer
	 * @var string
	 **/
	private $beerStyle;

	/**
	 * constructor for class beer
	 * @param int $newbeerId new value of beer id
	 * @param int $newbeerBreweryId new value of brewery id
	 * @param float $newbeerAbv new value of beer abv
	 * @param string $newbeerAvailability tells us if beer is available year round or seasonally
	 * @param string $newbeerAwards tells us all of the awards that this beer has been awarded
	 * @param float $newbeerColor new value of beer color between 0 and 1
	 * @param string $newbeerDescription tells about the details of the beer should not exceed 2000 characters
	 * @param string $newbeerIbu states how many Ibu's are present in the beer
	 * @param string $newbeerName displays the name of the beer
	 * @param string $newbeerStyle is used to assign industry style label
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of range (e.g., strings are too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(int $newbeerId, int $newbeerBreweryId, float $newbeerAbv, string $newbeerAvailability, string $newbeerAwards, float $newbeerColor, string $newbeerDescription, string $newbeerIbu, string $newbeerName, string $newbeerStyle) {
		try{
			$this->setbeerId($newbeerId);
			$this->setbeerBreweryId($newbeerBreweryId);
			$this->setbeerAbv($newbeerAbv);
			$this->setbeerAvailability($newbeerAvailability);
			$this->setbeerAwards($newbeerAwards);
			$this->setbeerColor($newbeerColor);
			$this->setbeerDescription($newbeerDescription);
			$this->setbeerIbu($newbeerIbu);
			$this->setbeerName($newbeerName);
			$this->setbeerStyle($newbeerStyle);
	}		catch(\InvalidArgumentException $invalidArgument){
			//rethrow the exception to the caller
				throw(new \InvalidArgumentException($invalidArgument->getMessage(),0,$invalidArgument));
		}	catch(\RangeException $range){
		//rethrow the exception to the caller
				throw(new \RangeException($range->getMessage(), 0, $range));
		}	catch(\TypeError $typeError){
			//rethrow the exception to the caller
				throw (new \TypeError($typeError->getMessage(), 0, $typeError));
		}	catch(\Exception $exception){
			//rethrow the exception to the caller
				throw (new \Exception($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessors and mutators for class beer
	 **/
	/**
	 * accessor method for beer id
	 * @return int value of beer id
	 **/
	public function getbeerId() {
		return ($this->beerId);
	}

	/**
	 *mutator method for beer id
	 *
	 * @param int $newbeerId new value of beer id
	 * @throws \RangeException if $newbeerId is not positive
	 * @throws \TypeError if $newbeerId is not an integer
	 **/
	public function setbeerId($newbeerId) {
		//verify the profile id is positive
		if($newbeerId <= 0) {
			throw (new \RangeException("beer id is not positive"));
		}
		//convert and store the beer id
		$this->beerId = $newbeerId;
	}

	/**accessor method for brewery id
	 * @return int value of brewery id
	 **/
	public function getbeerBreweryId() {
		return ($this->beerBreweryId);
	}

	/**
	 * mutator method for brewery id
	 *
	 * @param int $newbeerBreweryId new value of brewery id
	 * @throws \RangeException if $newbeerBreweryId is not positive
	 * @throws \TypeError if $newbeerBreweryId is not an integer
	 **/
	public function setbeerBreweryId($newbeerBreweryId) {
		//verify the brewery id is positive
		if($newbeerBreweryId <= 0) {
			throw (new \RangeException("brewery id is not positive"));
		}
		//convert and store the new brewery id
		$this->breweryId = $newbeerBreweryId;
	}

	/**
	 * accessor method for beer abv
	 * @return float value for beer abv
	 **/
	public function getbeerAbv() {
		return ($this->beerAbv);
	}

	/**
	 * mutator method for beer abv
	 *
	 * @param float $newbeerAbv new value of beer abv
	 * @throws \RangeException if $newbeerAbv is less than zero or greater than 100%
	 * @throws \TypeError if $newbeerAbv is not a float
	 **/
	public function setbeerAbv($newbeerAbv) {
		//verify the beer abv is between 0% and 100%
		if($newbeerAbv < 0 || $newbeerAbv > 100) {
			throw (new \RangeException ("beer abv is out of range"));
		}
		//convert and store the new beer abv
		$this->beerAbv = $newbeerAbv;
	}

	/**
	 * accessor method for beer availability
	 * @return string for beer availability
	 **/
	public function getbeerAvailability() {
		return ($this->beerAvailability);
	}

	/**
	 *mutator method for beer availablity
	 *
	 * @param string $newbeerAvailability tells us if beer is available year round or seasonally
	 * @throws \InvalidArgumentException if $newbeerAvailability is not a string or is insecure
	 * @throws \RangeException if $newbeerAvailability is > 100 characters
	 * @throws \TypeError if $newbeerAvailability is not a string
	 **/
	public function setbeerAvailability($newbeerAvailability) {
		//verify the beer availabilty content is secure
		$newbeerAvailability = trim($newbeerAvailability);
		$newbeerAvailability = filter_var($newbeerAvailability, FILTER_SANITIZE_STRING);
		if(empty($newbeerAvailability) === true){
			throw(new \InvalidArgumentException("Beer availability content is either empty or insecure"));
		}
		//verify the beer availability content will fit in the database
		if(strlen($newbeerAvailability) > 100) {
			throw (new \RangeException("string is greater than 100 characters"));
		}
		//convert and store the new beer availability
		$this->beerAvailability = $newbeerAvailability;
	}

	/**
	 * accessor method for beer awards
	 * @return string value of beer awards
	 **/
	public function getbeerAwards() {
		return ($this->beerAwards);
	}

	/**
	 * mutator method for beer awards
	 * @param string $newbeerAwards tells us all of the awards that this beer has been awarded
	 * @throws \InvalidArgumentException if $newbeerAwards is not a string or is insecure
	 * @throws \RangeException if $newbeerAwards is greater that  1000 characters
	 * @throws \TypeError if $newbeerAwards is not a string
	 **/
	public function setbeerAwards($newbeerAwards) {
		//verify the beer awards content is secure
		$newbeerAwards = trim($newbeerAwards);
		$newbeerAwards = filter_var($newbeerAwards, FILTER_SANITIZE_STRING);
		if(empty($newbeerAwards) === true){
			throw (new \InvalidArgumentException("beer awards content is either empty or insecure"));
		}
		//verify the beer awards content will fit in the database
		if(strlen($newbeerAwards) > 1000) {
			throw (new \RangeException("beer awards description is greater than 1000 characters"));
		}
		//convert and store the new beer awards
		$this->beerAwards = $newbeerAwards;
	}

	/**
	 * accessor method for beer color
	 * @return float value of beer color
	 **/
	public function getbeerColor() {
		return ($this->beerColor);
	}

	/**mutator method for beer color
	 * @param float $newbeerColor new value of beer color between 0 and 1
	 * @throws \RangeException if $newbeerColor is less than zero or greater than 1
	 * @throws \TypeError if $newbeerColor is not a float
	 **/
	public function setbeerColor($newbeerColor) {
		//verify the beer abv is between 0 and 1
		if($newbeerColor < 0 || $newbeerColor > 1) {
			throw (new \RangeException ("beer color is out of range"));
		}
		//convert and store the new beer color
		$this->beerColor = $newbeerColor;
	}

	/**
	 * accessor method for beer description
	 * @return string value of beer description
	 **/
	public function getbeerDescription() {
		return ($this->beerDescription);
	}

	/**
	 * mutator method for beer description
	 * @param string $newbeerDescription tells about the details of the beer should not exceed 2000 characters
	 * @throws \InvalidArgumentException if $newbeerDescription is not a string or is insecure
	 * @throws \RangeException if the string exceeds 2000 characters
	 **/
	public function setbeerDescription($newbeerDescription) {
		//verify the beer description content is secure
		$newbeerDescription = trim($newbeerDescription);
		$newbeerDescription = filter_var($newbeerDescription, FILTER_SANITIZE_STRING);
		if(empty($newbeerDescription) === true){
			throw (new \InvalidArgumentException("beer description is either empty or insecure"));
		}
		if(strlen($newbeerDescription) > 2000) {
			throw (new \RangeException("beer description is greater than 2000 characters"));
		}
		//store the beer description content
		$this->beerDescription = $newbeerDescription;
	}

	/**
	 * accessor method for beer ibu
	 * @return string value for beer ibu
	 **/
	public function getbeerIbu() {
		return ($this->beerIbu);
	}

	/**
	 * mutator method for beerIbu
	 * @param string $newbeerIbu states how many Ibu's are present in the beer
	 * @throws \InvalidArgumentException if $newbeerIbu is not a string or is insecure
	 * @throws \RangeException if the string exceeds 50 characters
	 * @throws \TypeError if $newbeerIbu is not a string
	 **/
	public function setbeerIbu($newbeerIbu) {
		//verify the beer ibu content is secure
		$newbeerIbu = trim($newbeerIbu);
		$newbeerIbu = filter_var($newbeerIbu, FILTER_SANITIZE_STRING);
		if(empty($newbeerIbu) === true) {
			throw (new \InvalidArgumentException("beer IBU content is either empty or insecure"));
		}
		//verify the tweet content will fit in the database
		if(strlen($newbeerIbu) > 50) {
			throw (new \RangeException("beer IBU contains more than 50 characters"));
		}
		//store the beer IBU content
		$this->beerIbu = $newbeerIbu;
	}

	/**
	 * accessor method for beer name
	 * @return string for for beer name not null
	 **/
	public function getbeerName() {
		return ($this->beerName);
	}

	/**
	 * mutator method for beer name
	 * @param string $newbeerName displays the name of the beer
	 * @throws \InvalidArgumentException if $newbeerName is not a string or is insecure
	 * @throws \RangeException if string exceeds 64 characters
	 * @throws \TypeError if $newbeerName is not a string
	 **/
	public function setbeerName($newbeerName) {
		//verify the beer name content is secure
		$newbeerName = trim($newbeerName);
		$newbeerName = filter_var($newbeerName, FILTER_SANITIZE_STRING);
		if (empty($newbeerName)=== true){
			throw(new \InvalidArgumentException("beer name is either empty or insecure"));
		}
		//verify the beer name content will fit in the database
		if(strlen($newbeerName) > 64) {
			throw (new \RangeException("beer name contains more than 64 characters"));
		}
		//store the beer name
		$this->beerName = $newbeerName;
	}

	/**
	 * accessor method for beer style
	 * @return string to describe industry style label
	 **/
	public function getbeerStyle() {
		return ($this->beerStyle);
	}

	/**
	 * mutator method for beer stlye
	 * @param string $newbeerStyle is used to assign industry style label
	 * @throws \InvalidArgumentException if $newbeerStyle content is not a string or is insecure
	 * @throws \RangeException if string exceeds 32 characters
	 **/
	public function setbeerStyle($newbeerStyle) {
		//verify the beer style content is secure
		$newbeerStyle = trim($newbeerStyle);
		$newbeerStyle = filter_var($newbeerStyle, FILTER_SANITIZE_STRING);
		if(empty($newbeerStyle) === true){
			throw (new \InvalidArgumentException("beer style content is either empty or insecure"));
		}
		//verify the content of beer style can fit in the database
		if(strlen($newbeerStyle) > 32) {
			throw (new \RangeException("beer style is greater than 32 characters"));
		}
		//store the beer style content
		$this->beerStyle = $newbeerStyle;
	}
}