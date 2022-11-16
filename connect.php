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

?>