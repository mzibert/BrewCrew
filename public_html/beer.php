<?php>
namespace Edu\Cnm\mzibert\BrewCrew;

require_once ("autoload.php");

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
	/** string of open text field taken from the API used to describe the beer
	 * @var string $beerDescription
	 **/
	private $beerDescription;
	/** Integer used to evaluate the quantitative value designated to the measurement of bitterness in beer.  Lower values less bitter, higher values more bitter.
	 * @var int $beerIbu
	 **/
	private $beerIbu;
	/** string of open text field for the name of the beer
	 * @var string $beerName
	 **/
	private $beerName;
	/** string used to capture the industry standard style label of the beer
	 * @var string $beerStyle
	 **/
	private $beerName;
}
/**
 * constructor for class beer
 **/
/**
 * accessors and mutators for class beer
 **/
/**
 * accessor method for beer id
 * @return int value of beer id
 */
	public function getbeerId(){
		return($this->beerId);
}
/**
 *mutator method for beer id
 *
 * @param int $newbeerId new value of beer id
 * @throws \RangeException if $newbeerId is not positive
 * @throws \TypeError if $newbeerId is not an integer
 **/
	public function setbeerId($newbeerId){
	//verify the profile id is positive
		if($newbeerId <= 0){
			throw (new \RangeException("beer id is not positive"));
		}
	//convert and store the beer id
	$this->beerId = $newbeerId;
}
