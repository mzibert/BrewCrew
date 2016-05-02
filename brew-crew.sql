DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS brewery;
DROP TABLE IF EXISTS beer;
DROP TABLE IF EXISTS review;
DROP TABLE IF EXISTS beerTag;
DROP TABLE IF EXISTS reviewTag;
DROP TABLE IF EXISTS tag;

CREATE TABLE user (
	userId  INT UNSIGNED AUTO_INCREMENT NOT NULL,
	userBreweryId  INT UNSIGNED NOT NULL,
	userAccessLevel  INT UNSIGNED NOT NULL,
	userActivationToken  INT UNSIGNED NOT NULL,
	userDateOfBirth  DATE NOT NULL,
	userFirstName  VARCHAR(32) NOT NULL,
	userLastName  VARCHAR(32) NOT NULL,
	userEmail  VARCHAR(128) NOT NULL,
	username  VARCHAR(32) NOT NULL,
	userHash  CHAR(64),
	userSalt  CHAR(128),
	UNIQUE(username),
	UNIQUE(userEmail),
	PRIMARY KEY (userId)
);

CREATE TABLE brewery (
   breweryId INT UNSIGNED AUTO_INCREMENT NOT NULL,
   breweryDescription VARCHAR(1000),
   breweryEstDate VARCHAR(150),
   breweryHours VARCHAR(250),
   breweryPhone VARCHAR(14),
   breweryName VARCHAR(100) NOT NULL,
   breweryUrl VARCHAR(100),
	INDEX(breweryName),
   PRIMARY KEY(breweryId)
);
CREATE TABLE beer (
   beerId INT UNSIGNED AUTO_INCREMENT NOT NULL,
   beerBreweryId INT UNSIGNED                NOT NULL,
   beerAbv DECIMAL(6, 5),
   beerAvailability VARCHAR(100),
   beerAwards VARCHAR(1000),
   beerColor DECIMAL(6, 5),
   beerDescription CHAR(2000),
   beerIbu INT(3) UNSIGNED,
   beerName CHAR(64) NOT NULL,
	INDEX(beerBreweryId),
	FOREIGN KEY (beerBreweryId) REFERENCES brewery(breweryId),
	PRIMARY KEY(beerId)
);

CREATE TABLE review (
   reviewId INT UNSIGNED AUTO_INCREMENT NOT NULL,
   reviewbeerId INT UNSIGNED NOT NULL,
   reviewUserId INT UNSIGNED NOT NULL,
   reviewPintRating INT UNSIGNED NOT NULL,
   reviewDate TIMESTAMP,
   reviewText VARCHAR(2000),
	INDEX(reviewbeerId),
	INDEX(reviewUserId),
	INDEX(reviewPintRating),
   FOREIGN KEY (reviewbeerId) REFERENCES beer(beerId),
   FOREIGN KEY (reviewUserId) REFERENCES review(reviewUserId),
   PRIMARY KEY (reviewId)
);

CREATE TABLE tag (
	tagId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	tagLabel VARCHAR(64) NOT NULL,
	PRIMARY KEY (tagId)
);

CREATE TABLE beerTag (
	beerTagBeerId INT UNSIGNED NOT NULL,
	beerTagTagId INT UNSIGNED NOT NULL,
	INDEX(beerTagBeerId),
	INDEX(beerTagTagId),
	FOREIGN KEY(beerTagBeerId) REFERENCES beer(beerId),
	FOREIGN KEY(beerTagTagId) REFERENCES tag(tagId)
);

CREATE TABLE reviewTag (
	reviewTagReviewId INT UNSIGNED NOT NULL,
	reviewTagTagId INT UNSIGNED NOT NULL,
	INDEX(reviewTagReviewId),
	INDEX(reviewTagTagId),
	FOREIGN KEY(reviewTagReviewID) REFERENCES review(reviewId),
	FOREIGN KEY(reviewTagTagId) REFERENCES tag(tagId)
);