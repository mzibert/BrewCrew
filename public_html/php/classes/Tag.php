<?php

namespace Edu\Cnm\BrewCrew;
require_once("autoload.php");

/**
 * This class contains data and functionality for a (flavor) tag.
 *
 * @author Kate McGaughey therealmcgaughey@gmail.com
 */

class Tag implements \JsonSerializable {

	/**
	 * ID for the tag; this is the primary key
	 * @var int $tagId
	 */
	private $tagId;

	/**
	 * Label for the tag
	 * @var string $tagLabel
	 */
	private $tagLabel;

	/** Constructor for this Tag
	 *
	 * @param int|null $newTagId id of this tag or null if a new tag
	 * @param string $newTagLabel string describing flavor
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function __construct(int $newTagId = null, string $newTagLabel) {
		try {
			$this->setTagId($newTagId);
			$this->setTagLabel($newTagLabel);
		} catch(InvalidArgumentException $invalidArgument) {
			// Rethrow exception to the caller
			throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch
		(RangeException $range) {
			// Rethrow exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch
		(\Exception $exception) {
			// Rethrow exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
		
		/** Accessor method for tagId
		 *
		 * @return int|null value of Tag id
		 **/
		public function getTagId() {
			return ($this->tagId);
		}

		/** Mutator method for tagId
		 *
		 * @param int $newTagId new value of tag Id
		 * @throws \RangeException if $newTagId is not positive
		 * @throws \TypeError if $newTagId is not an integer
		 */
		public function setTagId(int $newTagId = null) {
			//base case: If tagId is null, this is a new tag without a mySQL assigned id yet
			if($newTagId === null) {
				$this->tagId = null;
				return;
			}
			//verify the tag id is positive
			if($newTagId <= 0) {
				throw (new \RangeException("tag id is not positive"));
			}
			//convert and store the tag id
			$this->tagId = $newTagId;
		}

		/** Accessor method for tag label
		 *
		 * @return string tag label (tag for flavors)
		 **/
		public function getTagLabel() {
			return ($this->tagLabel);
		}

		/** Mutator method for tag label
		 *
		 * @param string $newTagLabel new value of flavor tag
		 * @throws \InvalidArgumentException if $newTagLabel is not a string or is insecure
		 * @throws \RangeException if string exceeds 64 characters
		 **/
		public function setTagLabel($newTagLabel) {
			//verify the tag label content is secure
			$newTagLabel = trim($newTagLabel);
			$newTagLabel = filter_var($newTagLabel, FILTER_SANITIZE_STRING);
			if(empty($newTagLabel) === true) {
				throw (new \InvalidArgumentException("tag label field is empty or insecure"));
			}
			if(strlen($newTagLabel) > 64) {
				throw (new \RangeException("tag label field is greater than 64 characters"));
			}
			//store the tag label content
			$this->tagLabel = $newTagLabel;
		}
	}
