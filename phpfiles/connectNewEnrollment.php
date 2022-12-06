<?php
    //Includes the connection, so when you run queries you can use the $connect variable as the database link
    include 'connect.php';
    

    $semester = $_POST['semester'];
    $year = $_POST['year'];
    $studentId = $_POST['studentId'];
    $courseId = $_POST['courseId'];
    $grade = $_POST['grade'];
    $enrollment_id = $semester.$year.$studentId.$courseId;

$result = mysqli_query($connect, "SELECT course_id FROM courses WHERE course_id = '$courseId'");


if($result->num_rows == 0) {
     // row not found, do stuff...
     echo "ERROR: you must enter the class enformation before enrollment information";
} else {

    $stmt = $connect->prepare("Insert ignore into enrollments(enrollment_id, semester, year, student_id, course_id, grade)
    values(?, ?, ?, ?, ?, ?)");

    //Below ensures the values are read as the proper data type
    $stmt->bind_param("ssssss", $enrollment_id, $semester, $year, $studentId, $courseId, $grade);



    $stmt->execute();
    
    echo "Form added to database successfully!";
    $stmt->close();
        
    //Reroutes to show the query page 
    header("Location:showqueries.php");
    exit();
}
   
   
?>