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
	}
