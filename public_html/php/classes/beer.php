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
	 * @param int $newBeerId new value of beer id
	 * @param int $newBeerBreweryId new value of brewery id
	 * @param float $newBeerAbv new value of beer abv
	 * @param string $newBeerAvailability tells us if beer is available year round or seasonally
	 * @param string $newBeerAwards tells us all of the awards that this beer has been awarded
	 * @param float $newBeerColor new value of beer color between 0 and 1
	 * @param string $newBeerDescription tells about the details of the beer should not exceed 2000 characters
	 * @param string $newBeerIbu states how many Ibu's are present in the beer
	 * @param string $newBeerName displays the name of the beer
	 * @param string $newBeerStyle is used to assign industry style label
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of range (e.g., strings are too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(int $newBeerId, int $newBeerBreweryId, float $newBeerAbv, string $newBeerAvailability, string $newBeerAwards, float $newBeerColor, string $newBeerDescription, string $newBeerIbu, string $newBeerName, string $newBeerStyle) {
		try{
			$this->setBeerId($newBeerId);
			$this->setBeerBreweryId($newBeerBreweryId);
			$this->setBeerAbv($newBeerAbv);
			$this->setBeerAvailability($newBeerAvailability);
			$this->setBeerAwards($newBeerAwards);
			$this->setBeerColor($newBeerColor);
			$this->setBeerDescription($newBeerDescription);
			$this->setBeerIbu($newBeerIbu);
			$this->setBeerName($newBeerName);
			$this->setBeerStyle($newBeerStyle);
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
	public function getBeerId() {
		return ($this->beerId);
	}

	/**
	 *mutator method for beer id
	 *
	 * @param int $newBeerId new value of beer id
	 * @throws \RangeException if $newbeerId is not positive
	 * @throws \TypeError if $newBeerId is not an integer
	 **/
	public function setBeerId($newBeerId) {
		//verify the profile id is positive
		if($newBeerId <= 0) {
			throw (new \RangeException("beer id is not positive"));
		}
		//convert and store the beer id
		$this->beerId = $newBeerId;
	}

	/**accessor method for brewery id
	 * @return int value of brewery id
	 **/
	public function getBeerBreweryId() {
		return ($this->beerBreweryId);
	}

	/**
	 * mutator method for brewery id
	 *
	 * @param int $newBeerBreweryId new value of brewery id
	 * @throws \RangeException if $newBeerBreweryId is not positive
	 * @throws \TypeError if $newBeerBreweryId is not an integer
	 **/
	public function setBeerBreweryId($newBeerBreweryId) {
		//verify the brewery id is positive
		if($newBeerBreweryId <= 0) {
			throw (new \RangeException("brewery id is not positive"));
		}
		//convert and store the new brewery id
		$this->breweryId = $newBeerBreweryId;
	}

	/**
	 * accessor method for beer abv
	 * @return float value for beer abv
	 **/
	public function getBeerAbv() {
		return ($this->beerAbv);
	}

	/**
	 * mutator method for beer abv
	 *
	 * @param float $newBeerAbv new value of beer abv
	 * @throws \RangeException if $newbeerAbv is less than zero or greater than 100%
	 * @throws \TypeError if $newbeerAbv is not a float
	 **/
	public function setBeerAbv($newBeerAbv) {
		//verify the beer abv is between 0% and 100%
		if($newBeerAbv < 0 || $newBeerAbv > 100) {
			throw (new \RangeException ("beer abv is out of range"));
		}
		//convert and store the new beer abv
		$this->beerAbv = $newBeerAbv;
	}

	/**
	 * accessor method for beer availability
	 * @return string for beer availability
	 **/
	public function getBeerAvailability() {
		return ($this->beerAvailability);
	}

	/**
	 *mutator method for beer availablity
	 *
	 * @param string $newBeerAvailability tells us if beer is available year round or seasonally
	 * @throws \InvalidArgumentException if $newbeerAvailability is not a string or is insecure
	 * @throws \RangeException if $newbeerAvailability is > 100 characters
	 * @throws \TypeError if $newbeerAvailability is not a string
	 **/
	public function setBeerAvailability($newBeerAvailability) {
		//verify the beer availabilty content is secure
		$newBeerAvailability = trim($newBeerAvailability);
		$newBeerAvailability = filter_var($newBeerAvailability, FILTER_SANITIZE_STRING);
		if(empty($newBeerAvailability) === true){
			throw(new \InvalidArgumentException("Beer availability content is either empty or insecure"));
		}
		//verify the beer availability content will fit in the database
		if(strlen($newBeerAvailability) > 100) {
			throw (new \RangeException("string is greater than 100 characters"));
		}
		//convert and store the new beer availability
		$this->beerAvailability = $newBeerAvailability;
	}

	/**
	 * accessor method for beer awards
	 * @return string value of beer awards
	 **/
	public function getBeerAwards() {
		return ($this->beerAwards);
	}

	/**
	 * mutator method for beer awards
	 * @param string $newBeerAwards tells us all of the awards that this beer has been awarded
	 * @throws \InvalidArgumentException if $newbeerAwards is not a string or is insecure
	 * @throws \RangeException if $newbeerAwards is greater that  1000 characters
	 * @throws \TypeError if $newbeerAwards is not a string
	 **/
	public function setBeerAwards($newBeerAwards) {
		//verify the beer awards content is secure
		$newBeerAwards = trim($newBeerAwards);
		$newBeerAwards = filter_var($newBeerAwards, FILTER_SANITIZE_STRING);
		if(empty($newBeerAwards) === true){
			throw (new \InvalidArgumentException("beer awards content is either empty or insecure"));
		}
		//verify the beer awards content will fit in the
		// database
		if(strlen($newBeerAwards) > 1000) {
			throw (new \RangeException("beer awards description is greater than 1000 characters"));
		}
		//convert and store the new beer awards
		$this->beerAwards = $newBeerAwards;
	}

	/**
	 * accessor method for beer color
	 * @return float value of beer color
	 **/
	public function getBeerColor() {
		return ($this->beerColor);
	}

	/**mutator method for beer color
	 * @param float $newBeerColor new value of beer color between 0 and 1
	 * @throws \RangeException if $newbeerColor is less than zero or greater than 1
	 * @throws \TypeError if $newbeerColor is not a float
	 **/
	public function setBeerColor($newBeerColor) {
		//verify the beer abv is between 0 and 1
		if($newBeerColor < 0 || $newBeerColor > 1) {
			throw (new \RangeException ("beer color is out of range"));
		}
		//convert and store the new beer color
		$this->beerColor = $newBeerColor;
	}

	/**
	 * accessor method for beer description
	 * @return string value of beer description
	 **/
	public function getBeerDescription() {
		return ($this->beerDescription);
	}

	/**
	 * mutator method for beer description
	 * @param string $newBeerDescription tells about the details of the beer should not exceed 2000 characters
	 * @throws \InvalidArgumentException if $newbeerDescription is not a string or is insecure
	 * @throws \RangeException if the string exceeds 2000 characters
	 **/
	public function setBeerDescription($newBeerDescription) {
		//verify the beer description content is secure
		$newBeerDescription = trim($newBeerDescription);
		$newBeerDescription = filter_var($newBeerDescription, FILTER_SANITIZE_STRING);
		if(empty($newBeerDescription) === true){
			throw (new \InvalidArgumentException("beer description is either empty or insecure"));
		}
		if(strlen($newBeerDescription) > 2000) {
			throw (new \RangeException("beer description is greater than 2000 characters"));
		}
		//store the beer description content
		$this->beerDescription = $newBeerDescription;
	}

	/**
	 * accessor method for beer ibu
	 * @return string value for beer ibu
	 **/
	public function getBeerIbu() {
		return ($this->beerIbu);
	}

	/**
	 * mutator method for beerIbu
	 * @param string $newBeerIbu states how many Ibu's are present in the beer
	 * @throws \InvalidArgumentException if $newbeerIbu is not a string or is insecure
	 * @throws \RangeException if the string exceeds 50 characters
	 * @throws \TypeError if $newbeerIbu is not a string
	 **/
	public function setBeerIbu($newBeerIbu) {
		//verify the beer ibu content is secure
		$newBeerIbu = trim($newBeerIbu);
		$newBeerIbu = filter_var($newBeerIbu, FILTER_SANITIZE_STRING);
		if(empty($newBeerIbu) === true) {
			throw (new \InvalidArgumentException("beer IBU content is either empty or insecure"));
		}
		//verify the tweet content will fit in the database
		if(strlen($newBeerIbu) > 50) {
			throw (new \RangeException("beer IBU contains more than 50 characters"));
		}
		//store the beer IBU content
		$this->beerIbu = $newBeerIbu;
	}

	/**
	 * accessor method for beer name
	 * @return string for for beer name not null
	 **/
	public function getBeerName() {
		return ($this->beerName);
	}

	/**
	 * mutator method for beer name
	 * @param string $newBeerName displays the name of the beer
	 * @throws \InvalidArgumentException if $newbeerName is not a string or is insecure
	 * @throws \RangeException if string exceeds 64 characters
	 * @throws \TypeError if $newbeerName is not a string
	 **/
	public function setBeerName($newBeerName) {
		//verify the beer name content is secure
		$newBeerName = trim($newBeerName);
		$newBeerName = filter_var($newBeerName, FILTER_SANITIZE_STRING);
		if (empty($newBeerName)=== true){
			throw(new \InvalidArgumentException("beer name is either empty or insecure"));
		}
		//verify the beer name content will fit in the database
		if(strlen($newBeerName) > 64) {
			throw (new \RangeException("beer name contains more than 64 characters"));
		}
		//store the beer name
		$this->beerName = $newBeerName;
	}

	/**
	 * accessor method for beer style
	 * @return string to describe industry style label
	 **/
	public function getBeerStyle() {
		return ($this->beerStyle);
	}

	/**
	 * mutator method for beer stlye
	 * @param string $newBeerStyle is used to assign industry style label
	 * @throws \InvalidArgumentException if $newbeerStyle content is not a string or is insecure
	 * @throws \RangeException if string exceeds 32 characters
	 **/
	public function setBeerStyle($newBeerStyle) {
		//verify the beer style content is secure
		$newBeerStyle = trim($newBeerStyle);
		$newBeerStyle = filter_var($newBeerStyle, FILTER_SANITIZE_STRING);
		if(empty($newBeerStyle) === true){
			throw (new \InvalidArgumentException("beer style content is either empty or insecure"));
		}
		//verify the content of beer style can fit in the database
		if(strlen($newBeerStyle) > 32) {
			throw (new \RangeException("beer style is greater than 32 characters"));
		}
		//store the beer style content
		$this->beerStyle = $newBeerStyle;
	}
}