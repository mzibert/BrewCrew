DROP TABLE IF EXISTS reviewTag;
DROP TABLE IF EXISTS beerTag;
DROP TABLE IF EXISTS tag;
DROP TABLE IF EXISTS review;
DROP TABLE IF EXISTS beer;
DROP TABLE IF EXISTS user;  -- This is a comment in sql
DROP TABLE IF EXISTS brewery;


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
	INDEX(userBreweryId),
	FOREIGN KEY (userBreweryId) REFERENCES brewery(breweryId),
	PRIMARY KEY (userId)
);

CREATE TABLE beer (
   beerId INT UNSIGNED AUTO_INCREMENT NOT NULL,
   beerBreweryId INT UNSIGNED NOT NULL,
   beerAbv DECIMAL(6, 5),
   beerAvailability VARCHAR(100),
   beerAwards VARCHAR(1000),
   beerColor DECIMAL(6, 5),
   beerDescription VARCHAR(2000),
   beerIbu INT(3) UNSIGNED,
   beerName VARCHAR(64) NOT NULL,
	beerStyle VARCHAR (32),
	INDEX(beerBreweryId),
	INDEX(beerIbu),
	INDEX(beerColor),
	INDEX(beerStyle),
	FOREIGN KEY (beerBreweryId) REFERENCES brewery(breweryId),
	PRIMARY KEY(beerId)
);

CREATE TABLE review (
   reviewId INT UNSIGNED AUTO_INCREMENT NOT NULL,
   reviewbeerId INT UNSIGNED NOT NULL,
   reviewUserId INT UNSIGNED NOT NULL,
   reviewPintRating TINYINT(1) UNSIGNED NOT NULL,
   reviewDate TIMESTAMP,
   reviewText VARCHAR(2000),
	INDEX(reviewbeerId),
	INDEX(reviewUserId),
	INDEX(reviewPintRating),
	FOREIGN KEY (reviewbeerId) REFERENCES beer(beerId),
	FOREIGN KEY (reviewUserId) REFERENCES user(userId),
	PRIMARY KEY (reviewId)
);

CREATE TABLE tag (
	tagId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	tagLabel VARCHAR(64) NOT NULL,
	INDEX (tagLabel),
	PRIMARY KEY (tagId)
);

CREATE TABLE beerTag (
	beerTagBeerId INT UNSIGNED NOT NULL,
	beerTagTagId INT UNSIGNED NOT NULL,
	INDEX(beerTagBeerId),
	INDEX(beerTagTagId),
	FOREIGN KEY(beerTagBeerId) REFERENCES beer(beerId),
	FOREIGN KEY(beerTagTagId) REFERENCES tag(tagId),
	PRIMARY KEY (beerTagBeerId, beerTagTagId)
);

CREATE TABLE reviewTag (
	reviewTagReviewId INT UNSIGNED NOT NULL,
	reviewTagTagId INT UNSIGNED NOT NULL,
	INDEX(reviewTagReviewId),
	INDEX(reviewTagTagId),
	FOREIGN KEY(reviewTagReviewID) REFERENCES review(reviewId),
	FOREIGN KEY(reviewTagTagId) REFERENCES tag(tagId),
	PRIMARY KEY (reviewTagReviewId, reviewTagTagId)
);