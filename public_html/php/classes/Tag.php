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
			// Verify the tag label content is secure
			$newTagLabel = trim($newTagLabel);
			$newTagLabel = filter_var($newTagLabel, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			if(empty($newTagLabel) === true) {
				throw (new \InvalidArgumentException("tag label field is empty or insecure"));
			}
			if(strlen($newTagLabel) > 64) {
				throw (new \RangeException("tag label field is greater than 64 characters"));
			}
			// Store the tag label content
			$this->tagLabel = $newTagLabel;
		}

		// PDO
		/**
		 * Inserts this tag into mySQL
		 *
		 * @param \PDO $pdo PDO connection object
		 * @throws \PDOException when mySQL-related errors occur
		 * @throws \TypeError if $pdo is not a PDO connection object
		 **/
		public function insert(\PDO $pdo) {
			// Make sure this is a new tag
			if($this->tagId !== null) {
				throw(new \PDOException("Not a new tag"));
			}
			// Crete query template
			$query = "INSERT INTO tag(tagId, tagLabel) VALUES (:tagId, :tagLabel)";
			$statement = $pdo->prepare($query);

			// Bind the member variables to the place holders in the template
			$parameters = ["tagId" => $this->getTagId(), "tagLabel" => $this->getTagLabel()];
			$statement->execute($parameters);

			// Update the null tag id with what mySQL generated
			$this->setTagId(intval($pdo->lastInsertId()));
		}
		/**
		 * Deletes this tag from mySQL
		 *
		 * @param PDO $pdo PDO connection object
		 * @throws \PDOException when mySQL-related errors occur
		 * @throws \TypeError if $pdo is not a PDO connection object
		 **/
		public function delete(\PDO $pdo) {
			// Make sure this tag exists
			if($this->tagId === null) {
				throw (new \PDOException("Unable to delete a tag that does not exist"));
			}
			// Create query template
			$query = "DELETE FROM tag WHERE tagId = :tagId";
			$statement = $pdo->prepare($query);

			// Bind the member variables to the placeholders in the templates
			$parameters = ["tagId" => $this->getTagId(),];
			$statement->execute($parameters);
		}
		/**
		 * Updates this tag in mySQL
		 *
		 * @param \PDO $pdo PDO connection object
		 * @throws \PDOException when mySQL-related errors occur
		 * @throws \TypeError if $pdo is not a PDO connection object
		 * **/
		public function update(\PDO $pdo) {
			// Make sure this tag exists
			if($this->tagId === null) {
				throw(new \PDOException("Unable to update a tag that does not exist"));
			}
			// Create query template
			$query = "UPDATE tag SET tagLabel = :tagLabel WHERE tagId = :tagId";
			$statement = $pdo->prepare($query);

			//Bind the member variables to the placeholders in the templates
			$parameters = ["tagId" => $this->getTagId(), "tagLabel" => $this->getTagLabel()];
			$statement->execute($parameters);
		}
		
	}
