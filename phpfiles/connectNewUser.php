<?php
    //Includes the connection, so when you run queries you can use the $connect variable as the database link
    include 'connect.php';

    $idNumber = $_POST['idNumber'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $isStudent = (isset($_POST['isStudent'])) ? 1 : 0;

    /*INSERT INTO t1 (a,b,c) VALUES (1,2,3)
  ON DUPLICATE KEY UPDATE c=c+1;*/

    $stmt = $connect->prepare("Insert into users(id_number, fname, lname, email, age, is_student)
    values(?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE fname=values(fname), lname=values(lname), email=values(email), age=values(age), is_student=values(is_student)");
    //Below ensures the values are read as the proper data type
    $stmt->bind_param("isssii", $idNumber, $firstName, $lastName, $email, $age, $isStudent);
    $stmt->execute();
    echo "Form added to database successfully!";
    $stmt->close();

    // insert into students if is_student is true
    if ($isStudent == 1) {
        $stmt = "INSERT IGNORE INTO students(id_number)
        VALUES('$idNumber')";
    } else { // insert into professors
        $stmt = "INSERT IGNORE INTO professors(id_number)
        VALUES('$idNumber')";
    }
    $query = mysqli_query($connect, $stmt);
        
    //Reroutes to show the query page 
    header("Location:showqueries.php");
    exit();
?>