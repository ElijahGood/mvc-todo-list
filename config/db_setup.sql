CREATE DATABASE IF NOT EXISTS `beejee` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `beejee`;

CREATE TABLE IF NOT EXISTS users
(id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
login varchar(255) NOT NULL,
email varchar(255) NOT NULL, 
password varchar(255) NOT NULL);

CREATE TABLE IF NOT EXISTS tasks
(id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
user_name varchar(255) NOT NULL,
user_email varchar(255) NOT NULL,
task_text varchar(255) NOT NULL,
date_time datetime,
checked BOOLEAN DEFAULT false);