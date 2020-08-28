CREATE DATABASE RD5;
USE DATABASE RD5;
CREATE TABLE users (id int NOT NULL PRIMARY KEY AUTO_INCREMENT,account varchar(30),password varchar(60),personID varchar(30),money int);
CREATE TABLE userTransactionInfo(id int NOT NULL ,account varchar(30),datatime timestamp  DEFAULT CURRENT_TIMESTAMP,actionName varchar(30),amount varchar(30),status varchar(30),accountBalance varchar(30));

create table userTransactionInfo(id int NOT NULL PRIMARY KEY  ,account varchar(30),datatime timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,actionName varchar(30),amount varchar(30),status varchar(30),accountBalance varchar(30), FOREIGN KEY (id) REFERENCES users(id));