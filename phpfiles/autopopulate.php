<?php
include 'connect.php';

//This script works to autopopulate the database with some users, courses, enrollments, and instances of teaches

    
    //First we need to add all of the users
    //Going to attempt to put the values in a JSON file and then read from there

    $jsondata = file_get_contents('autopopulate.json');
    $data = json_decode($jsondata, true);


    foreach ($data as $row){

if($row['table'] == 'user'){ //If json object is a user
    $idNumber = $row['userid'];
    $firstName = $row['fname'];
    $lastName = $row['lname'];
    $email = $row['email'];
    $age = $row['age'];
    $isStudent = $row['is_student'];
    $stmt = "INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
    VALUES('$idNumber', '$firstName', '$lastName', '$email', '$age', '$isStudent')";

    
    $query = mysqli_query($connect, $stmt);

    // insert into students if is_student is true
    if ($isStudent == 1) {
        $stmt = "INSERT IGNORE INTO students(id_number)
        VALUES('$idNumber')";
    } else { // insert into professors
        $stmt = "INSERT IGNORE INTO professors(id_number)
        VALUES('$idNumber')";
    }
    $query = mysqli_query($connect, $stmt);
    }

else if($row['table'] == 'course'){ //If json object is a course
    $courseId = $row['courseid'];
    $courseName = $row['coursename'];
    $courseSubject = $row['coursesubject'];
    $courseCredits = $row['coursecredits'];

    $coursestmt = "INSERT IGNORE INTO courses(course_id, course_name, course_subject, course_credits)
    VALUES('$courseId', '$courseName', '$courseSubject', '$courseCredits')";

    $courseQuery = mysqli_query($connect, $coursestmt);
    }

else if ($row['table'] == 'enrollments'){ //If json object is an enrollment
        $semester = $row['semester'];
        $year = $row['year'];
        $studentId = $row['studentid'];
        $courseId = $row['courseid'];
        $grade = $row['grade'];
        $enrollment_id = $semester.$year.$studentId.$courseId;

        $enrollmentstmt = "INSERT IGNORE INTO enrollments(enrollment_id, semester, year, student_id, course_id, grade)
        VALUES('$enrollment_id', '$semester', '$year', '$studentId', '$courseId', '$grade')";

        $enrollmentQuery = mysqli_query($connect, $enrollmentstmt);
    }

    else if ($row['table'] == 'teaches'){ //If json object is an enrollment
        $idNumber = $row['idnumber'];
        $courseId = $row['courseid'];
        $semester = $row['semester'];
        $year = $row['year'];

        $teachesstmt = "INSERT IGNORE INTO teaches(id_number, course_id, semester, year)
        VALUES('$idNumber', '$courseId', '$semester', '$year')";

        $enrollmentQuery = mysqli_query($connect, $teachesstmt);
    }


}

 
    echo 'Form added to database successfully!';
    header("Location:showqueries.php");
    
    
    exit();
?>