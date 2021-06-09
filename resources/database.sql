CREATE TABLE `users` (
  `usersId` int(11) NOT NULL AUTO_INCREMENT,
  `usersName` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersUid` varchar(128) NOT NULL,
  `usersPwd` varchar(128) NOT NULL,
   PRIMARY KEY (`usersId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `collaborators` (
  `codeId` int(11) NOT NULL,
  `collaboratorUserId` varchar(60) NOT NULL ,
  `pkCollab` int(11) NOT NULL PRIMARY key AUTO_INCREMENT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `cod` (
  `codId` int(11) NOT NULL AUTO_INCREMENT,
  `codUsersName` varchar(128) NOT NULL,
  `codName` varchar(128) NOT NULL,
  `codValability` int(11) NOT NULL,
  `codVisibility` varchar(128) NOT NULL,
  `codPwd` varchar(128) DEFAULT NULL,
  `codeText` longtext NOT NULL,
  `creation_date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`codId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
