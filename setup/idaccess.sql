CREATE DATABASE idaccess;

USE idaccess;

CREATE TABLE user (id varchar(40), username varchar(255) not null, password varchar(255) not null, primary key(id))engine=innodb;

CREATE TABLE role (id varchar(40), role_name varchar(255) not null, primary key(id))engine=innodb;

CREATE TABLE role_user (user_id varchar(40), role_id varchar(40), primary key(user_id, role_id), foreign key (user_id) references user(id), foreign key (role_id) references role(id))engine=innodb;

INSERT INTO user VALUES ('first-user', 'customer', md5('customer'));
INSERT INTO role VALUES ('first-role', 'customer');
INSERT INTO role_user VALUES ('first-user', 'first-role');
