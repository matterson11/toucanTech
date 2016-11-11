<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'toucan';
$dbconfig = mysqli_connect($host,$username,$password,$database);


/*
$members = "create table members (
id int(6) not null auto_increment,
name varchar(64),
email varchar(64) not null,
uploaded_at date not null,
primary key (id),
unique (email)
)";

$dbconfig->query($members);

$schools = "create table schools (
id int(6) not null auto_increment,
name varchar(64) not null,
uploaded_at datetime not null,
primary key (id),
unique (name)
)";

$dbconfig->query($schools);

$member_school = "create table member_school (
member_id int(6) not null,
school_id int(6) not null
)";

$dbconfig->query($member_school);

*/