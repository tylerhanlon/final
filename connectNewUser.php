<?php
//Includes the connection, so when you run queries you can use the $connect variable as the database link
 include 'connect.php';


    $idNumber = $_POST['idNumber'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $isStudent = (isset($_POST['isStudent'])) ? 1 : 0;


    //Now we connect to the database

    //Use the below format to addd things to tables. We should php file for each thing we are connecting
    
    //Change below to create the database and tables if theey do not already exist 
    // $conn = new mysqli('localhost','root','','final');
    // if($conn->connect_error){
    //     die('Connection Failed : ' .$conn->connect_error);
    // } else {
        $stmt = $connect->prepare("Insert into users(id_number, fname, lname, email, age, is_student)
        values(?, ?, ?, ?, ?, ?)");
        //Below ensures the values are read as the proper data type
        $stmt->bind_param("isssii", $idNumber, $firstName, $lastName, $email, $age, $isStudent);
        $stmt->execute();
        echo "Form added to database successfully!";
        $stmt->close();
    //     $conn->close();
        
        //Reroutes to show the query page 
          header("Location:showqueries.php");
          exit();
    // }


?>