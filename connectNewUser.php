<?php
    $idNumber = $_POST['idNumber'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $isStudent = (isset($_POST['isStudent'])) ? 1 : 0;

    //Now we connect to the database

    //Use the below format to addd things to tables. We should php file for each thing we are connecting
    
    $conn = new mysqli('localhost','root','','final');
    if($conn->connect_error){
        die('Connection Failed : ' .$conn->connect_error);
    } else {
        $stmt = $conn->prepare("Insert into user(id_number, fname, lname, email, age, is_student)
        values(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssii", $idNumber, $firstName, $lastName, $email, $age, $isStudent);
        $stmt->execute();
        echo "Form added to database successfully!";
        $stmt->close();
        $conn->close();
        
        //Reroutes to show the query page 
         header("Location:showqueries.php");
         exit();
    }


?>