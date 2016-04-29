CREATE TABLE Brewery (
breweryId INT UNSIGNED AUTO_INCREMENT,
breweryDescription VARCHAR(1000),
breweryEstDate VARCHAR(150),
breweryHours VARCHAR(250),
breweryPhone VARCHAR(14),
breweryName VARCHAR(100) NOT NULL,
breweryUrl VARCHAR(100),
PRIMARY KEY(breweryId)
);