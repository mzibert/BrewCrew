<?php
namespace Edu\Cnm\mzibert\BrewCrew;

(require_once ("autoload.php"));

class beerTag {
	/**
	 * this is the Id for this beer that this beer tag refers to, this is the foreign key
	 * @var int $beerTagBeerId
	 **/
private $beerTagBeerId;
	/**
	 * this is the Id for this tag that was applied to this specific beer tag, this is a foreign key
	 * @var int $beerTagTagId
	 **/
private $beerTagTagId;

/**
 * Constructor for class beerTag
 * 
 **/
}
	/**
	 * accessors and mutators for class beerTag
	 */
/**
 * accessor method for beerTagBeerId
 * @return int value of beer Tag Beer Id
 **/
public function getBeerTagBeerId(){
	return ($this->beerTagBeerId);
}
/**
 * mutator method for beer tag beer Id
 * @param int $newBeerTagBeerId new value of beer tag beer Id
 * @throws \RangeException if $newBeerTagBeerId is not positive
 * @throws \TypeError if $newBeerTagBeerId is not an integer
 **/
public function setBeerTagBeerId($newBeerTagBeerId){
	//verify the beer tag beer id content is positive
	if($newBeerTagBeerId <=0){
		throw (new \RangeException("beer tag beer id is not positive"));
	}
	// convert and store the new beer tag beer id
	$this->beerTagBeerId=$newBeerTagBeerId;
}
/**
 * accessor method for beerTagTagId
 * @return int value of beer tag tag Id
 **/
public function getBeerTagTagId(){
	return ($this->beerTagTagId);
}
/**
 * mutator method for beer tag tag id
 * @param int $newBeerTagTagId new value of the tag id assigned to this beer
 * @throws \RangeException if $newBeerTagTagId is not positive
 * @throws \TypeError if $newBeerTagTagId is not an integer
 **/
public function setBeerTagTagId($newBeerTagTagId){
	//verify the beer tag tag Id content is positive
	if($newBeerTagTagId <=0){
		throw (new \RangeException("beer tag tag Id is not positive"));
	}
	//convert and store the beer tag tag Id
	$this->beerTagTagId=$newBeerTagTagId;
}