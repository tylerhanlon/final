<?php
    //Includes the connection
    include 'connect.php';

    $idNumber = $_POST['idNumber'];
    $field = $_POST['field'];
    $level = $_POST['level'];

    //Belowq throws primary key error so commented for now. Maybe just throw an error if ID is not present and make user register
    // //Insert new values into professors if idNumber is not there
    // $stmt = $connect->prepare("Insert into professors(id_number, field, level_of_education)
    // values(?, ?, ?)");
    // //Read values in proper format
    // $stmt->bind_param("iss", $idNumber, $field, $level);
    // $stmt->execute();

    //If ID is found then update
    $query = "UPDATE professors SET field = ?, level_of_education = ? WHERE id_number =?";
    $stmt = $connect->prepare($query);
    //Read values in proper format
    $stmt->bind_param("ssi", $field, $level, $idNumber);
    $stmt ->execute();

    echo "Form added to database successfully!";
    $stmt->close();

    //Reroutes to show the query page 
    header("Location:showqueries.php");
    exit();
?>