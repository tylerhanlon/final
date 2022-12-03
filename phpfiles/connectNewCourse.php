<?php
    //Includes the connection
    include 'connect.php';

    $courseId = $_POST['courseId'];
    $courseName = $_POST['courseName'];
    $courseSubject = $_POST['courseSubject'];
    $courseCredits = $_POST['courseCredits'];

    $stmt = $connect->prepare("Insert into courses(course_id, course_name, course_subject, course_credits)
    values(?, ?, ?, ?)");

    //Read values in proper format (all varchar in this case except credits)
    $stmt->bind_param("sssi", $courseId, $courseName, $courseSubject, $courseCredits);
    $stmt->execute();
    echo "Form added to database successfully!";
    $stmt->close();

    //Reroutes to show the query page 
    header("Location:showqueries.php");
    exit();
?>