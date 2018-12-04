CREATE DATABASE php8am;
CREATE TABLE tbl_students(
id int AUTO_INCREMENT PRIMARY KEY,
name varchar(100) not null,
email varchar(100) UNIQUE,
password varchar(100),
gender ENUM('male','female'),
language SET('nepali','english','chinese'),
country varchar(100)
);
