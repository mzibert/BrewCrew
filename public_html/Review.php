<?php
namespace Edu\Cnm\BREWCREW;

require_once("autoload.php");

/**
 * Review Class
 *
 * This class consists of everything required to create and manage a review system for the Beer Compass webapp. This will allow users to choose a rating from a 5-point scale, and create an optional text review for any given beer in the system.  Once tied with the ReviewTag class, users will be able to link beers with associated flavor tags.
 *
 * @author Alicia Broadhurst <abroadhurst@cnm.edu>
 *
 */

class Review implements \JsonSerializable {
	use ValidateDate;
	/**
	 * review id; the primary key
	 * @var int $reviewId
	 *
	 */
	private $reviewId;
	/**
	 * reviewBeerId (aka beerId); a foreign key
	 * @var int $reviewBeerId
	 */
	private $reviewBeerId;
	/**
	 * reviewUserId (aka userId); a foreign key
	 * @var int $reviewUserId
	 */
	private $reviewUserId;
	/**
	 * reviewPintRating, the assigned rating for a beer on a 5-point scale
	 * @var int $reviewPintRating
	 */
	private $reviewPintRating;
	/**
	 * reviewDate, the associated timestamp for a review
	 * @var \DateTime $reviewDate
	 */
	private $reviewDate;
	/**
	 * reviewText, text content for the review
	 * @var string $reviewText
	 */
	private $reviewText;
	

}


