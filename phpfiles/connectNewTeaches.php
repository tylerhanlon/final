<?php
    //Includes the connection, so when you run queries you can use the $connect variable as the database link
    include 'connect.php';
    

    $id_number = $_POST['id_number'];
    $course_id = $_POST['course_id'];
    $semester = $_POST['semester'];
    $year = $_POST['year'];


$result = mysqli_query($connect, "SELECT course_id FROM courses WHERE course_id = '$course_id'");


if($result->num_rows == 0) {
     // row not found, do stuff...
     echo "ERROR: you must enter the class enformation before instructor information";
} else {

    $stmt = $connect->prepare("Insert into teaches(id_number, course_id, semester, year)
    values(?, ?, ?, ?)");

    //Below ensures the values are read as the proper data type
    $stmt->bind_param("ssss", $id_number, $course_id, $semester, $year);



    $stmt->execute();
    
    echo "Form added to database successfully!";
    $stmt->close();
        
    //Reroutes to show the query page 
    header("Location:showqueries.php");
    exit();
}
   
   
?>