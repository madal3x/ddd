CREATE DATABASE reporting;

USE REPORTING;

CREATE TABLE report (id varchar(40), type varchar(255), username varchar(255), role_name varchar(255), status varchar(255), date_created datetime not null, primary key(id))engine=innodb;