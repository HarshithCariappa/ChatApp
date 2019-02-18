-- insert msgender data
INSERT INTO `chatapp`.`msgender` (`GenderID`, `Gender`) VALUES ('1', 'Male');
INSERT INTO `chatapp`.`msgender` (`GenderID`, `Gender`) VALUES ('2', 'Female');
INSERT INTO `chatapp`.`msgender` (`GenderID`, `Gender`) VALUES ('3', 'Other');

-- insert msyear data
INSERT INTO `chatapp`.`msyear` (`YearId`, `Year`, `Active`) VALUES ('1', '1st Year', '1');
INSERT INTO `chatapp`.`msyear` (`YearId`, `Year`, `Active`) VALUES ('2', '2nd Year', '1');
INSERT INTO `chatapp`.`msyear` (`YearId`, `Year`, `Active`) VALUES ('3', '3rd Year', '1');
INSERT INTO `chatapp`.`msyear` (`YearId`, `Year`, `Active`) VALUES ('4', '4th Year', '1');

-- insert msbranch data
INSERT INTO `chatapp`.`msbranch` (`BranchId`, `BranchAbbrivation`, `BranchName`, `Active`) VALUES ('1', 'CSE', 'Computer Science And Engineering', '1');
INSERT INTO `chatapp`.`msbranch` (`BranchId`, `BranchAbbrivation`, `BranchName`, `Active`) VALUES ('2', 'ISE', 'Information Science And Engineering', '1');
INSERT INTO `chatapp`.`msbranch` (`BranchId`, `BranchAbbrivation`, `BranchName`, `Active`) VALUES ('3', 'ME', 'Mechanical Engineering', '1');
INSERT INTO `chatapp`.`msbranch` (`BranchId`, `BranchAbbrivation`, `BranchName`, `Active`) VALUES ('4', 'CV', 'Civil Engineering', '1');
INSERT INTO `chatapp`.`msbranch` (`BranchId`, `BranchAbbrivation`, `BranchName`, `Active`) VALUES ('5', 'EC', 'Electronics And Communication', '1');


INSERT INTO `chatapp`.`cfgconversations` (`ConversationID`, `FromUID`, `ToUID`) VALUES ('1', '1', '8');
INSERT INTO `chatapp`.`cfgmessages` (`MessageId`, `ConversationId`, `SenderUID`, `Message`, `Read`) VALUES ('1', '1', '1', 'Hello', '1');
