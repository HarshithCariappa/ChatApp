-- create the schema
CREATE SCHEMA `chatapp` ;

-- create msbranch table
CREATE TABLE `chatapp`.`msbranch` (
`BranchId` INT NOT NULL AUTO_INCREMENT,
`BranchAbbrivation` VARCHAR(45) NULL,
`BranchName` VARCHAR(45) NULL,
`Active` TINYINT NULL DEFAULT 1,
PRIMARY KEY (`BranchId`));

-- create msyear table
CREATE TABLE `chatapp`.`msyear` (
`YearId` INT NOT NULL AUTO_INCREMENT,
`Year` VARCHAR(45) NULL,
`Active` TINYINT NULL DEFAULT 1,
PRIMARY KEY (`YearId`));

-- create appuser table
CREATE TABLE `chatapp`.`appuser` (
`UID` INT NOT NULL AUTO_INCREMENT,
`FirstName` VARCHAR(45) NULL,
`LastName` VARCHAR(45) NULL,
`USN` VARCHAR(45) NULL,
`Email` VARCHAR(45) NULL,
`GenderID` INT NULL,
`BranchId` INT NULL,
`YearId` INT NULL,
`Password` VARCHAR(45) NULL,
`CreatedOn` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
`Active` INT NULL DEFAULT 1,
PRIMARY KEY (`UID`));

-- create msgender table
CREATE TABLE `chatapp`.`msgender` (
`GenderID` INT NOT NULL AUTO_INCREMENT,
`Gender` VARCHAR(45) NULL,
PRIMARY KEY (`GenderID`));

-- altering appuser table
ALTER TABLE `chatapp`.`appuser`
ADD INDEX `fk_au_branchID_idx` (`BranchId` ASC),
ADD INDEX `fk_au_genderId_idx` (`GenderID` ASC),
ADD INDEX `fk_au_yearId_idx` (`YearId` ASC);
ALTER TABLE `chatapp`.`appuser`
ADD CONSTRAINT `fk_au_branchID`
FOREIGN KEY (`BranchId`)
REFERENCES `chatapp`.`msbranch` (`BranchId`)
ON DELETE NO ACTION
ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_au_genderId`
FOREIGN KEY (`GenderID`)
REFERENCES `chatapp`.`msgender` (`GenderID`)
ON DELETE NO ACTION
ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_au_yearId`
FOREIGN KEY (`YearId`)
REFERENCES `chatapp`.`msyear` (`YearId`)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

-- create cfgconversations table
CREATE TABLE `chatapp`.`cfgconversations` (
`ConversationID` INT NOT NULL AUTO_INCREMENT,
`FromUID` INT NULL,
`ToUID` INT NULL,
`CreatedOn` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
`Unread` INT NULL DEFAULT 1,
PRIMARY KEY (`ConversationID`),
INDEX `fk_ac_fromID_idx` (`FromUID` ASC),
INDEX `fk_ac_toUID_idx` (`ToUID` ASC),
CONSTRAINT `fk_cc_fromID`
FOREIGN KEY (`FromUID`)
REFERENCES `chatapp`.`appuser` (`UID`)
ON DELETE NO ACTION
ON UPDATE NO ACTION,
CONSTRAINT `fk_cc_toUID`
FOREIGN KEY (`ToUID`)
REFERENCES `chatapp`.`appuser` (`UID`)
ON DELETE NO ACTION
ON UPDATE NO ACTION);

-- create trkchats table
CREATE TABLE `chatapp`.`trkchats` (
`ChatID` INT NOT NULL AUTO_INCREMENT,
`ConversationId` INT NULL,
`Conversation` VARCHAR(400) NULL,
`SentOn` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`ChatID`),
INDEX `fk_tc_converstionID_idx` (`ConversationId` ASC),
CONSTRAINT `fk_tc_converstionID`
FOREIGN KEY (`ConversationId`)
REFERENCES `chatapp`.`cfgconversations` (`ConversationID`)
ON DELETE NO ACTION
ON UPDATE NO ACTION);

-- alter cfgconversations table
ALTER TABLE `chatapp`.`cfgconversations`
CHANGE COLUMN `CreatedOn` `SentOn` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ,
ADD COLUMN `Conversation` VARCHAR(400) NULL AFTER `Unread`;

-- alter appuser table
ALTER TABLE `chatapp`.`appuser`
ADD COLUMN `LastLogin` DATETIME NULL DEFAULT CURRENT_TIMESTAMP AFTER `Active`,
ADD COLUMN `LastLogout` DATETIME NULL DEFAULT CURRENT_TIMESTAMP AFTER `LastLogin`,
ADD COLUMN `Online` INT NULL DEFAULT 0 AFTER `LastLogout`;

-- alter appuser table
ALTER TABLE `chatapp`.`appuser`
CHANGE COLUMN `USN` `USN` VARCHAR(45) NOT NULL ,
CHANGE COLUMN `Email` `Email` VARCHAR(45) NOT NULL ,
ADD UNIQUE INDEX `USN_UNIQUE` (`USN` ASC),
ADD UNIQUE INDEX `Email_UNIQUE` (`Email` ASC);

-- alter cfgconversations table
ALTER TABLE `chatapp`.`cfgconversations`
DROP COLUMN `Conversation`,
CHANGE COLUMN `SentOn` `CreatedOn` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ,
CHANGE COLUMN `Unread` `Active` INT(11) NULL DEFAULT '1' ;

-- create cfgmessages table
CREATE TABLE `chatapp`.`cfgmessages` (
`MessageId` INT NOT NULL AUTO_INCREMENT,
`ConversationId` INT NULL,
`SenderUID` INT NULL,
`SentOn` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
`Message` VARCHAR(400) NULL,
`Read` INT NULL DEFAULT 1,
`Active` INT NULL DEFAULT 1,
PRIMARY KEY (`MessageId`),
INDEX `fk_cm_CnversationId_idx` (`ConversationId` ASC),
INDEX `fk_cm_senderUid_idx` (`SenderUID` ASC),
CONSTRAINT `fk_cm_ConversationId`
FOREIGN KEY (`ConversationId`)
REFERENCES `chatapp`.`cfgconversations` (`ConversationID`)
ON DELETE NO ACTION
ON UPDATE NO ACTION,
CONSTRAINT `fk_cm_senderUid`
FOREIGN KEY (`SenderUID`)
REFERENCES `chatapp`.`appuser` (`UID`)
ON DELETE NO ACTION
ON UPDATE NO ACTION);