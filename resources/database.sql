#We create database "ProiectTW"
#Then, we created the table users

CREATE TABLE users(
    usersId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    usersName varchar(128) NOT NULL,
    usersEmail varchar(128) NOT NULL,
    usersUid varchar(128) NOT NULL,
    usersPwd varchar(128) NOT NULL
);

CREATE TABLE colab(
    codId int(11) NOT NULL,
    codUsersId int(11) NOT NULL
);
CREATE TABLE cod(
    codId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    codText LONGTEXT NOT NULL,
    codUsersName varchar(128) NOT NULL,
    codName varchar(128) NOT NULL,
    codValability int(11) NOT NULL,
    codVisibility varchar(128) NOT NULL,
    codPwd varchar(128)
);