CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersName` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersUid` varchar(128) NOT NULL,
  `usersPwd` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `colab` (
  `codId` int(11) NOT NULL,
  `codUsersId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `cod` (
  `codId` int(11) NOT NULL,
  `codUsersName` varchar(128) NOT NULL,
  `codName` varchar(128) NOT NULL,
  `codValability` int(11) NOT NULL,
  `codVisibility` varchar(128) NOT NULL,
  `codPwd` varchar(128) DEFAULT NULL,
  `codeText` longtext NOT NULL,
  `creation_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

