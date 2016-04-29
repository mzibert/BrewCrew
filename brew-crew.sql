DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS brewery;
DROP TABLE IF EXISTS beer;
DROP TABLE IF EXISTS review;
DROP TABLE IF EXISTS beerTag;
DROP TABLE IF EXISTS review;
DROP TABLE IF EXISTS tag;

CREATE TABLE brewery (
   breweryId INT UNSIGNED AUTO_INCREMENT,
   breweryDescription VARCHAR(1000),
   breweryEstDate VARCHAR(150),
   breweryHours VARCHAR(250),
   breweryPhone VARCHAR(14),
   breweryName VARCHAR(100) NOT NULL,
   breweryUrl VARCHAR(100),
   PRIMARY KEY(breweryId)
);

CREATE TABLE review (
   reviewId INT UNSIGNED AUTO_INCREMENT,
   beerId INT UNSIGNED NOT NULL,
   reviewUserId INT UNSIGNED NOT NULL,
   reviewPintRating INT UNSIGNED NOT NULL,
   reviewDate TIMESTAMP,
   reviewText VARCHAR(2000),
   INDEX(reviewId),
   INDEX(reviewUserId),
   FOREIGN KEY (beerId) REFERENCES beer(beerId),
   FOREIGN KEY (reviewUserId) REFERENCES review(reviewUserId),
   PRIMARY KEY (reviewId)
);

CREATE TABLE  User  (
	userId  INT UNSIGNED AUTO_INCREMENT NOT NULL,
	userBreweryId  INT UNSIGNED AUTO_INCREMENT NOT NULL,
	userAccessLevel  INT UNSIGNED AUTO_INCREMENT NOT NULL,
	userActivationToken  INT UNSIGNED AUTO_INCREMENT NOT NULL,
	userDateOfBirth  DATE NOT NULL,
	userFirstName  VARCHAR(32) NOT NULL,
	userLastName  VARCHAR(32) NOT NULL,
	userEmail  VARCHAR(128) NOT NULL,
	username  VARCHAR(32) NOT NULL,
	userHash  <type>,
	userSalt  <type>,
	UNIQUE(username),
	UNIQUE(userEmail)
);

CREATE TABLE tag (
	tagId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	tagLabel VARCHAR(64) NOT NULL,
	PRIMARY KEY (tagId)
);

CREATE TABLE beerTag (
	beerTagBeerId INT UNSIGNED NOT NULL,
	beerTagTagId INT UNSIGNED NOT NULL,
	FOREIGN KEY(beerTagBeerId) REFERENCES beer(beerId),
	FOREIGN KEY(beerTagTagId) REFERENCES tag(tagId)
);

CREATE TABLE reviewTag (
	reviewTagReviewId INT UNSIGNED NOT NULL,
	reviewTagTagId INT UNSIGNED NOT NULL,
	FOREIGN KEY(reviewTagReviewID) REFERENCES review(reviewId),
	FOREIGN KEY(reviewTagTagId) REFERENCES tag(tagId)
);