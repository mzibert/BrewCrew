DROP TABLE IF EXISTS reviewTag;
DROP TABLE IF EXISTS beerTag;
DROP TABLE IF EXISTS tag;
DROP TABLE IF EXISTS review;
DROP TABLE IF EXISTS beer;
DROP TABLE IF EXISTS user;  -- This is a comment in sql
DROP TABLE IF EXISTS brewery;


CREATE TABLE brewery (
	breweryId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	breweryDbKey VARCHAR (6) NOT NULL,
	breweryDescription VARCHAR(5000),
	breweryEstDate SMALLINT,
	breweryHours VARCHAR(1000),
	breweryLocation VARCHAR (250),
	breweryName VARCHAR(100) NOT NULL,
	breweryPhone VARCHAR(20),
	breweryUrl VARCHAR(250),
	INDEX(breweryName),
	INDEX(breweryDbKey),
	PRIMARY KEY(breweryId)
);

CREATE TABLE user (
	userId  INT UNSIGNED AUTO_INCREMENT NOT NULL,
	userBreweryId  INT UNSIGNED,
	userAccessLevel  TINYINT UNSIGNED NOT NULL, -- or could be char with a letter
	userActivationToken  CHAR(32), -- because this is a hash it is char not int
	userDateOfBirth  DATE NOT NULL,
	userEmail  VARCHAR(128) NOT NULL,
	userFirstName  VARCHAR(32) NOT NULL,
	userHash  CHAR(128) NOT NULL,
	userLastName  VARCHAR(32) NOT NULL,
	userSalt  CHAR(64) NOT NULL,
	userUsername  VARCHAR(32) NOT NULL,
	UNIQUE(userUsername),
	UNIQUE(userEmail),
	INDEX(userBreweryId),
	FOREIGN KEY (userBreweryId) REFERENCES brewery(breweryId),
	PRIMARY KEY (userId)
);

CREATE TABLE beer (
   beerId INT UNSIGNED AUTO_INCREMENT NOT NULL,
   beerBreweryId INT UNSIGNED NOT NULL,
   beerAbv DECIMAL(5, 2),
   beerAvailability VARCHAR(100),
   beerAwards VARCHAR(1000),
   beerColor DECIMAL(6, 5),
	beerDbKey VARCHAR(6) NOT NULL,
   beerDescription VARCHAR(2000),
   beerIbu VARCHAR(50) NOT NULL,
   beerName VARCHAR(64) NOT NULL,
	beerStyle VARCHAR (32),
	INDEX(beerBreweryId),
	INDEX(beerIbu),
	INDEX(beerColor),
	INDEX(beerName),
	INDEX(beerStyle),
	FOREIGN KEY (beerBreweryId) REFERENCES brewery(breweryId),
	PRIMARY KEY(beerId)
);

CREATE TABLE review (
   reviewId INT UNSIGNED AUTO_INCREMENT NOT NULL,
   reviewBeerId INT UNSIGNED NOT NULL,
   reviewUserId INT UNSIGNED NOT NULL,
	reviewDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
   reviewPintRating TINYINT UNSIGNED NOT NULL,
   reviewText VARCHAR(2000),
	INDEX(reviewBeerId),
	INDEX(reviewUserId),
	INDEX(reviewPintRating),
	FOREIGN KEY (reviewBeerId) REFERENCES beer(beerId),
	FOREIGN KEY (reviewUserId) REFERENCES user(userId),
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




DELIMITER $$
	CREATE PROCEDURE maths(cColor DECIMAL, cIbu DECIMAL, colorStdDev DECIMAL, colorMean DECIMAL, ibuStdDev DECIMAL, ibuMean DECIMAL)
		BEGIN

			-- declare variables
			DECLARE scoreDistanceColor DECIMAL;
			DECLARE scoreDistanceIbu DECIMAL;
			DECLARE beerDrift DECIMAL;

			-- variables for cursor and loop control
			DECLARE done BOOLEAN DEFAULT FALSE; -- exit flag
			DECLARE mathCursor CURSOR FOR
				SELECT beerColor, beerIbu FROM beer; -- cursor
			DECLARE CONTINUE HANDLER FOR NOT FOUND
			SET done = TRUE; -- exit when no more rows

			OPEN mathCursor; -- open cursor
			mathLoop : LOOP -- start LOOP

			FETCH mathCursor INTO cColor, cIbu; -- gets rows
			IF done THEN LEAVE mathLoop; -- leaves rows
				END IF;

			SET scoreDistanceColor = ABS ((colorMean-cColor)/colorStdDev); -- colorDrift
			SET scoreDistanceIbu = ABS ((ibuMean-cIbu)/ibuStdDev); -- ibuDrift


			SET beerDrift = SQRT ((POW (scoreDistanceIbu, 2)) + (POW (scoreDistanceColor, 2)));

		END LOOP mathLoop; -- stops mad looping behavior
		CLOSE mathCursor; -- closes cursor

		SELECT beerDrift;

		END $$
DELIMITER ;





DELIMITER $$
	CREATE PROCEDURE recommendation(IN userId INT UNSIGNED)

		BEGIN
			-- declare variables
			DECLARE beerId INT UNSIGNED;
			DECLARE beerBreweryId INT UNSIGNED;
			DECLARE beerAbv DECIMAL(5, 2);
			DECLARE beerAvailability VARCHAR(100);
			DECLARE beerAwards VARCHAR(1000);
			DECLARE beerColor DECIMAL(6, 5);
			DECLARE beerDescription VARCHAR(2000);
			DECLARE beerIbu VARCHAR(50);
			DECLARE beerName VARCHAR(64);
			DECLARE beerStyle VARCHAR (32);
			DECLARE beerDrift DECIMAL;

			DECLARE cColor DECIMAL;
			DECLARE cIbu DECIMAL;
			DECLARE colorStdDev DECIMAL;
			DECLARE colorMean DECIMAL;
			DECLARE ibuStdDev DECIMAL;
			DECLARE ibuMean DECIMAL;


			-- variables for cursor and loop control
			DECLARE done BOOLEAN DEFAULT FALSE; -- exit flag
			DECLARE compassCursor CURSOR FOR
				SELECT (beerId, beerBreweryId, beerAbv, beerAvailability, beerAwards, beerColor, beerDescription, beerIbu, beerName, beerStyle) FROM beer; -- cursor
			DECLARE CONTINUE HANDLER FOR NOT FOUND
			SET done = TRUE; -- exit when no more rows

		-- create a temporary table to contain the recommended beers, empty at first; also has the drift variable
			DROP TEMPORARY TABLE IF EXISTS selectedBeer;
			CREATE TEMPORARY TABLE selectedBeer(
				beerId INT UNSIGNED NOT NULL,
				beerBreweryId INT UNSIGNED NOT NULL,
				beerAbv DECIMAL(5, 2),
				beerAvailability VARCHAR(100),
				beerAwards VARCHAR(1000),
				beerColor DECIMAL(6, 5),
				beerDescription VARCHAR(2000),
				beerIbu VARCHAR(50) NOT NULL,
				beerName VARCHAR(64) NOT NULL,
				beerStyle VARCHAR (32),
				beerDrift DECIMAL
			);

			OPEN compassCursor; -- open cursor
			compassLoop : LOOP -- start LOOP

			FETCH compassCursor INTO  selectedBeer; -- gets rows

			SELECT CONVERT(cIbu, DECIMAL);
			IF cIbu = 0 THEN SET cIbu = 120;
				END IF;

			SELECT STDDEV(cColor), AVG (cColor) INTO colorStdDev, colorMean FROM beer;
			SELECT STDDEV(cIbu), AVG(cIbu) INTO ibuStdDev, ibuMean FROM beer;

			CALL maths(beerDrift);
			FETCH beerDrift INTO selectedBeer;
				-- QUESTION will this match up okay? in terms of id/primary key

			IF done THEN LEAVE compassLoop; -- leaves rows
			END IF;

			END LOOP compassLoop; -- stops mad looping behavior
			CLOSE compassCursor; -- closes cursor

			SELECT (beerId, beerBreweryId, beerAbv, beerAvailability, beerAwards, beerColor, beerDescription, beerIbu, beerName, beerStyle, beerDrift) FROM selectedBeer WHERE beerDrift <= 1.5 -- the recommendation to return
			ORDER BY beerDrift;

		END $$
DELIMITER ;

INSERT INTO tag (tagLabel)
VALUES
	('Acidic');
INSERT INTO tag (tagLabel)
VALUES
	('Balanced');
INSERT INTO tag (tagLabel)
VALUES
	('Barrel-aged');
INSERT INTO tag (tagLabel)
VALUES
	('Bitter');
INSERT INTO tag (tagLabel)
VALUES
	('Carmelly');
INSERT INTO tag (tagLabel)
VALUES
	('Citrusy');
INSERT INTO tag (tagLabel)
VALUES
	('Cloudy');
INSERT INTO tag (tagLabel)
VALUES
	('Choclatey');
INSERT INTO tag (tagLabel)
VALUES
	('Crisp');
INSERT INTO tag (tagLabel)
VALUES
	('Dry');
INSERT INTO tag (tagLabel)
VALUES
	('Earthy');
INSERT INTO tag (tagLabel)
VALUES
	('Floral');
INSERT INTO tag (tagLabel)
VALUES
	('Full-bodied');
INSERT INTO tag (tagLabel)
VALUES
	('Fruity');
INSERT INTO tag (tagLabel)
VALUES
	('Heady');
INSERT INTO tag (tagLabel)
VALUES
	('Heavy');
INSERT INTO tag (tagLabel)
VALUES
	('Herbal');
INSERT INTO tag (tagLabel)
VALUES
	('Coffee');
INSERT INTO tag (tagLabel)
VALUES
	('Hoppy');
INSERT INTO tag (tagLabel)
VALUES
	('Malty');
INSERT INTO tag (tagLabel)
VALUES
	('Medium-bodied');
INSERT INTO tag (tagLabel)
VALUES
	('Mild');
INSERT INTO tag (tagLabel)
VALUES
	('Nutty');
INSERT INTO tag (tagLabel)
VALUES
	('Piney');
INSERT INTO tag (tagLabel)
VALUES
	('Rich');
INSERT INTO tag (tagLabel)
VALUES
	('Refreshing');
INSERT INTO tag (tagLabel)
VALUES
	('Robust');
INSERT INTO tag (tagLabel)
VALUES
	('Roasty');
INSERT INTO tag (tagLabel)
VALUES
	('Sessionable');
INSERT INTO tag (tagLabel)
VALUES
	('Skunky');
INSERT INTO tag (tagLabel)
VALUES
	('Sour');
INSERT INTO tag (tagLabel)
VALUES
	('Smoky');
INSERT INTO tag (tagLabel)
VALUES
	('Smooth');
INSERT INTO tag (tagLabel)
VALUES
	('Spicy');
INSERT INTO tag (tagLabel)
VALUES
	('Strong');
INSERT INTO tag (tagLabel)
VALUES
	('Sweet');
INSERT INTO tag (tagLabel)
VALUES
	('Tart');
INSERT INTO tag (tagLabel)
VALUES
	('Toasty');
INSERT INTO tag (tagLabel)
VALUES
	('Weak');
INSERT INTO tag (tagLabel)
VALUES
	('Woody');
INSERT INTO tag (tagLabel)
VALUES
	('Yeasty');