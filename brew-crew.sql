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
  UNIQUE(userEmail),
);