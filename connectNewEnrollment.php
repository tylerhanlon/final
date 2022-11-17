<?php
    //Includes the connection, so when you run queries you can use the $connect variable as the database link
    include 'connect.php';

    $semester = $_POST['semester'];
    $year = $_POST['year'];
    $studentId = $_POST['studentId'];
    $courseId = $_POST['courseId'];
    $grade = $_POST['grade'];

    $stmt = $connect->prepare("Insert into enrollments(semester, year, student_id, course_id, grade)
    values(?, ?, ?, ?, ?)");

    //Below ensures the values are read as the proper data type
    $stmt->bind_param("sssss", $semester, $year, $studentId, $courseId, $grade);
   
    $stmt->execute();
    
    echo "Form added to database successfully!";
    $stmt->close();
        
    //Reroutes to show the query page 
    header("Location:showqueries.php");
    exit();
?>