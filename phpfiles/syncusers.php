<?php
    //Includes the connection
    include 'connect.php';

    //Ugly but works for basic functionality (clean this up if we have time, doesnt need its own file)

    //Here we need the query to check through all users and determine which are students 
    $stmt = "INSERT INTO students (id_number) SELECT id_number from users where is_student = true";
    $query = mysqli_query($connect, $stmt);

    $stmt = "INSERT INTO professors (id_number) SELECT id_number from users where is_student = false";
    $query = mysqli_query($connect, $stmt);

    header("Location:showqueries.php");
    exit();
?>