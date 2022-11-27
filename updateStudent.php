<?php
    //Includes the connection
    include 'connect.php';

    $idNumber = $_POST['idNumber'];
    $major = $_POST['major'];
    $minor = $_POST['minor'];
    $focus= $_POST['focus'];

    //Insert new values into students if idNumber is not there
    $stmt = $connect->prepare("Insert into students(id_number, major, minor, focus)
    values(?, ?, ?, ?)");
    //Read values in proper format
    $stmt->bind_param("isss", $idNumber, $major, $minor, $focus);
    $stmt->execute();

    //If ID is found then update
    $query = "UPDATE students SET major = ?, minor = ?, focus = ? WHERE id_number =?";
    $stmt = $connect->prepare($query);
    //Read values in proper format
    $stmt->bind_param("sssi", $major, $minor, $focus, $idNumber);
    $stmt ->execute();

    echo "Form added to database successfully!";
    $stmt->close();

    //Reroutes to show the query page 
    header("Location:showqueries.php");
    exit();
?>