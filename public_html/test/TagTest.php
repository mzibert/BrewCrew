<?php
namespace Edu\Cnm\BrewCrew\Test;
// Grab the project test parameters
use Edu\Cnm\BrewCrew\Tag;
use PDOException;

require_once ("BrewCrewTest.php");

// Grab the class being tested
require_once (dirname(__DIR__) . "/php/classes/autoload.php");

/**
 * Full PHPUnit test for tag class
 *
 * This is a complete PHPUnit test of the tag class.
 *
 * @see \Edu\Cnm\BrewCrew\Tag
 * @author Kate McGaughey therealmcgaughey@gmail.com
 *
 */

class TagTest extends BrewCrewTest {

	/**
	 * Valid flavor label to use
	 * @var string $VALID_TAG_LABEL
	 */
	protected $VALID_TAG_LABEL = "Sweet";

	/**
	 * Test inserting a valid tag and verifying that the mySQL data matches
	 */
	public function testInsertValidTag() {
		// Count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("tag");

		// Create a new tag and insert it into mySQL
		$tag = new Tag(null, $this->VALID_TAG_LABEL);
		$tag->insert($this->getPDO());

		//Grab the data from mySQL and check the fields against our expectations
		$pdoTag = Tag::getTagByTagId($this->getPDO(), $tag->getTagId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tag"));
		$this->assertEquals($pdoTag->getTagLabel(), $this->VALID_TAG_LABEL);
	}

	/**
	 * Test inserting a tag that already exists
	 * @expectedException PDOException
	 */
	public function testInsertInvalidTag() {
		// Create a tag with a non null tag id and watch it fail
		$tag = new Tag(BrewCrewTest::INVALID_KEY, $this->VALID_TAG_LABEL);
		$tag->insert($this->getPDO());
	}

	/**
	 * Test inserting a tag, editing it, and then updating it
	 */
	public function testUpdateValidTag() {
		// Count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("tag");

		// Create a new tag and insert it into mySQL
		$tag = new Tag(null, $this->VALID_TAG_LABEL);
		$tag->insert($this->getPDO());

		// Edit the tag and update it in mySQL
		$tag->setTagLabel($this->VALID_TAG_LABEL);
		$tag->update($this->getPDO());

		// Grab the data from mySQL and enforce the fields match our expectations
		$pdoTag = Tag::getTagByTagLabel($this->getPDO(), $tag->getTagId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tag"));
		$this->assertEquals($pdoTag->getTagLabel(), $this->VALID_TAG_LABEL);
	}

	/**
	 * Test creating a tag and then deleting it
	 */
	public function testDeleteValidTag() {
		// Count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("tag");

		// Create a new tag and insert it into mySQL
		$tag = new Tag(null, $this->VALID_TAG_LABEL);
		$tag->insert($this->getPDO());

		// Delete the tag from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tag"));
		$tag->delete($this->getPDO());

		// Grab the data from MySQL and enforce the tag does not exist
		$pdoTag = Tag::getTagByTagId($this->getPDO(), $tag->getTagId());
		$this->assertNull($pdoTag);
		$this->assertSame($numRows, $this->getConnection()->getRowCount("tag"));
	}

	/**
	 * Test deleting a tag that doesn't exist
	 * @expectedException \PDOException
	 */
	public function testDeleteInvalidTag() {
		// Create a tag and then try to delete it without inserting it into mySQL
		$tag = new Tag(null, $this->VALID_TAG_LABEL);
		$tag->delete($this->getPDO());
	}

	/**
	 * Test getting a tag by valid tag id
	 */
	public function testGetTagbyValidTagId() {
		// Count the number of rows and save this for later
		$numRows = $this->getConnection()->getRowCount("tag");

		// Create a new tag and insert it into mySQL
		$tag = new Tag(null, $this->VALID_TAG_LABEL);
		$tag->insert($this->getPDO());

		// Grab the data from mySQL and check the fields against our expectations
		$pdoTag= Tag::getTagByTagId($this->getPDO(), $tag->getTagId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tag"));
		$this->assertLessThan($pdoTag->getTagId(), 0);
		$this->assertEquals($pdoTag->getTagLabel(), $this->VALID_TAG_LABEL);
	}

	/**
	 * Test getting a tag by invalid tag id
	 */
	public function testGetTagByInvalidTagId() {
		// Grab a tag by invalid key
		$tag = Tag::getTagByTagId($this->getPDO(), BrewCrewTest::INVALID_KEY);
		$this->assertNull($tag);
	}

	/**
	 * Test getting tag by tag label
	 */
	public function testGetTagByTagLabel() {
		// Count the number of rows and save this for later
		$numRows = $this->getConnection()->getRowCount("tag");

		// Create a new tag and insert it into mySQL
		$tag = new Tag(null, $this->VALID_TAG_LABEL);
		$tag->insert($this->getPDO());

		// Grab the data from mySQL and enforce the fields match our expectations
		$results = Tag::getTagByTagLabel($this->getPDO(), $tag->getTagLabel());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tag"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\BrewCrew\\Tag", $results);

		// Grab the result from the array and validate it
		$pdoTag = $results[0];
		$this->assertEquals($pdoTag->getTagLabel(), $this->VALID_TAG_LABEL);
	}

	/**
	 * Test getting all tags
	 */
	public function testGetAllValidTags() {
		// Count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("tag");

		// Create a new tag and insert to into mySQL
		$tag = new Tag(null, $this->VALID_TAG_LABEL);
		$tag->insert($this->getPDO());

		// Grab the data from mySQL and enforce the fields match our expectations
		$results = Tag::getAllTags($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tag"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Brewcrew\\Tag", $results);

		// Grab the result from the array and validate it
		$pdoTag = $results[0];
		$this->assertEquals($pdoTag->getTagLabel(), $this->VALID_TAG_LABEL);
	}
}