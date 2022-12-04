<?php   


//This file is used to create the database and tables if they do not exist

$connect = new mysqli('localhost', 'root', '');


// Create database if not exists.
$databaseName = 'final';
$query = 'CREATE DATABASE IF NOT EXISTS ' . $databaseName;

$result = mysqli_query($connect, $query);
// Use the new database for all future SQL queries.
mysqli_select_db($connect, $databaseName);


//Adds the users table
$createusers = 'CREATE TABLE IF NOT EXISTS users (
    id_number INT(9) NOT NULL PRIMARY KEY, 
    fname VARCHAR(30),
    lname VARCHAR(30),
    email VARCHAR(50),
    age INT(3),
    is_student INT(1)
    )';


if($connect->query($createusers)){
} else {
    echo "There was an error running the query";
}

$createstudents = 'CREATE TABLE IF NOT EXISTS students (
    id_number INT(9) NOT NULL PRIMARY KEY, 
    major VARCHAR(30),
    minor VARCHAR(30),
    focus VARCHAR(50)
    )';

if($connect->query($createstudents)){
} else {
    echo "There was an error running the query";
}

$createprofessors = 'CREATE TABLE IF NOT EXISTS professors (
    id_number INT(9) NOT NULL PRIMARY KEY, 
    field VARCHAR(30),
    level_of_education VARCHAR(30)
    )';

if($connect->query($createprofessors)){
} else {
    echo "There was an error running the query";
}

$createcourses = 'CREATE TABLE IF NOT EXISTS courses (
    course_id VARCHAR(7) NOT NULL PRIMARY KEY, 
    course_name VARCHAR(40),
    course_subject VARCHAR(30),
    course_credits INT(1)
    )';

if($connect->query($createcourses)){
} else {
    echo "There was an error running the query";
}


$createenrollments = 'CREATE TABLE IF NOT EXISTS enrollments (
    enrollment_id INT AUTO_INCREMENT PRIMARY KEY, 
    semester VARCHAR(40),
    year VARCHAR(30),
    student_id INT(9),
    course_id VARCHAR(30),
    grade VARCHAR(30)
    )';

if($connect->query($createenrollments)){
} else {
    echo "There was an error running the query";
}

$createteaches = 'CREATE TABLE IF NOT EXISTS teaches (
    teaches_id INT AUTO_INCREMENT PRIMARY KEY,
    id_number int(9) NOT NULL, 
    course_id VARCHAR(7),
    semester VARCHAR(40),
    year VARCHAR(30)
    )';

if($connect->query($createteaches)){
} else {
    echo "There was an error running the query";
}


?>