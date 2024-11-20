Drop table if exists pages;
drop table if exists categories;
drop table if exists users;
drop table if exists edits;
drop table if exists pageCategories;

# Each page is stored as a row in this table
create table pages(
id varchar(256) not null primary key,
name varchar(128),
pathFromRoot varchar(256),
content text
);

# Each category gets a row in this table
create table categories(
name varchar(128) primary key,
description text,
pathFromRoot varchar(256)
);

# Each user gets a row in this table
create table users(
id int primary key,
name varchar(128),
password varchar(256)
);

# Edits are stored in this table (TODO: figure out editing format for segmenting data)
create table edits(
pageID varchar(256) not null references pages(id),
userID int not null references users(id),
time timestamp,
comments text,
previousContent text,
newContent text,
primary key(pageID,userID,time)
);

# Table that links pages to specific categories
create table pageCategories(
pageID varchar(256) not null references pages(id),
catName varchar(128) references categories(name),
pageName varchar(128) references pages(name),
primary key(pageID, catName)
);

