CREATE DATABASE shop;

USE shop;

CREATE TABLE token (token varchar(40) not null, created_on datetime not null, last_used_on datetime not null, primary key(token));