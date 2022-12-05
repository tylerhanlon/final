<?php
 include 'connect.php';
// Will display the premade queries in tables.

  $exception = false;

if(isset($_POST['AGPC']))
{
    $input = "SELECT course_name, grade as most_frequent_grade FROM enrollments INNER JOIN courses on enrollments.course_id = courses.course_id AND grade != '' GROUP BY course_name ORDER BY most_frequent_grade ASC";
    $query = mysqli_query($connect, $input);
    $data = $query->fetch_all(MYSQLI_ASSOC);
    $exception = true;

} else if (isset($_POST['classes'])) {
    $sql = "CREATE VIEW list_classes AS SELECT course_name FROM courses";
    mysqli_query($connect, $sql); // creates view
    $input = "SELECT * from list_classes";
    $query = mysqli_query($connect, $input);
    $data = $query->fetch_all(MYSQLI_ASSOC);
    $exception = true;

} else if (isset($_POST['active'])) {
    $input = "SELECT DISTINCT CONCAT(UPPER(SUBSTRING(fname,1,1)),LOWER(SUBSTRING(fname,2))) as First_name, CONCAT(UPPER(SUBSTRING(lname,1,1)),LOWER(SUBSTRING(lname,2))) as Last_name
    from teaches LEFT OUTER JOIN USERS on teaches.id_number = USERS.id_number
    WHERE year = 2022";
    $query = mysqli_query($connect, $input);
    $data = $query->fetch_all(MYSQLI_ASSOC);
    $exception = true;
} else if (isset($_POST['taken'])) {
    $input = "SELECT fname as First_name, lname as Last_name
    FROM users
    WHERE id_number IN (
        SELECT id_number
        FROM students INNER JOIN enrollments ON students.id_number = enrollments.student_id
        WHERE course_id = 'CSC340'
        UNION
        SELECT id_number
        FROM students INNER JOIN enrollments ON students.id_number = enrollments.student_id
        WHERE course_id = 'CSC212')";
    $query = mysqli_query($connect, $input);
    $data = $query->fetch_all(MYSQLI_ASSOC);
    $exception = true;
} else if (isset($_POST['num'])) {
    $input = "SELECT COUNT(enrollment_id) as num_of_students, course_name
    FROM enrollments LEFT OUTER JOIN courses ON enrollments.course_id = courses.course_id
    WHERE year = 2022 AND course_name <> ' '
    GROUP BY course_name
    ORDER BY num_of_students DESC";
    $query = mysqli_query($connect, $input);
    $data = $query->fetch_all(MYSQLI_ASSOC);
    $exception = true;
} else if (isset($_POST['assisted'])) {
    $user = $_POST['assisted'];
    if(!empty($user)){
      try {
            $name = explode(" ", $_POST['assisted']);
            $input = $connect->prepare("SELECT grade, COUNT(grade) AS Num_given, teaches.course_id
            FROM ENROLLMENTs LEFT OUTER JOIN TEACHES on enrollments.course_id = teaches.course_id AND enrollments.semester = teaches.semester AND teaches.year = enrollments.year
            WHERE grade <> '' AND id_number IN (
            SELECT USERs.id_number
            FROM USERs
            WHERE fname = ? and lname = ?)
            GROUP BY grade, course_id");
            $input->bind_param("ss", $name[0], $name[1]);
            $input->execute();
            $query = $input->get_result();
            $data = $query->fetch_all(MYSQLI_ASSOC);
            $exception = true;
      } catch (mysqli_sql_exception $e) {
        echo "Invalid Input, please try again";
      }
  }
}

?>
  <div id="content">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  
<style>
    body {background-color: lightblue;}
    h1 {text-align: center;}
    #desc {text-align: center;}
</style>


<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
            <div class="navbar-nav">  
                <a class="nav-item nav-link" href="/final/html" >Add User</a>      
                <a class="nav-item nav-link" href="/final/html/addcourse.html" >Add Course</a>
                <a class="nav-item nav-link" href="/final/html/addenrollment.html" >Add Enrollment</a>
                <a class="nav-item nav-link" href="/final/html/addteaches.html">Add Instructor</a>
                <a class="nav-item nav-link" href="/final/html/updatestudent.html">Add/Update student information</a> 
                <a class="nav-item nav-link" href="/final/html/updateprofessor.html">Add/Update professor information</a> 
                <a class="nav-item nav-link" href="/final/phpfiles/showqueries.php">Query Builder</a>
                <a class="nav-item nav-link" href="/final/phpfiles/premade.php">Premade Queries</a>

            </div>
        </nav> 

<h1> Welcome to the Premade Query Page!</h1>
    <div class="row">
    <div class="text-center">
      <form action="premade.php" method="post">
          <div>
                <button type="submit" class="btn btn-success" name="AGPC" style="margin-top: 5px; font-size: 14.3px">Average Grade Per Course</button>
                <button type="submit" class="btn btn-success" name="classes" style="margin-top: 5px; font-size: 14.3px">List All CS Classes</button>
                <button type="submit" class="btn btn-success" name="active" style="margin-top: 5px; font-size: 14.3px">Active Professors in 2022</button>
                <button type="submit" class="btn btn-success" name="taken" style="margin-top: 5px; font-size: 14.3px;">Students who have taken CSC212 or CSC340</button>
                <button type="submit" class="btn btn-success" name="num" style="margin-top: 5px; font-size: 14.3px">Number of students in each course in 2022</button>
          </div>
          &nbsp;
                <h3>Fill out the Professor's First Name and Last Name to find out what grades they have given in what class</h3>
        <div class="card-body">
        <form action="premade.php" method="post" style="text-align: center; ">
        <div class="form-group">
        <div class="col d-flex justify-content-center"><div class="card"></card></div>
        <div class="row">
                                <div class="col-sm">
                                <label for="assisted">Name (Ex: "First Last")</label>
                                <input type="text" id="assisted" class="form-control" name="assisted" />
                            </div>
        </div>
                    <input type="submit" class="btn btn-primary"/>
                </form>
      </div>
        </div>
    </div>
                

<?php if($exception){ ?>
    <table style="width: auto !important; margin: auto" class="table table-dark">
        <thead> 
            <tr>
            <?php foreach ($query->fetch_fields() as $column){
              echo '<th>'.htmlspecialchars($column->name).'</th>';
            } ?>
            </tr> 
        </thead>
      <?php if($data) { 
      
        foreach ($data as $row) {
      echo '<tr>';
          foreach ($row as $cell) {
            
            echo '<td>'.htmlspecialchars($cell).'</td>';
          }
          echo '</tr>'; 
        }
    
   
       } else {
        echo '<tr><td colspan="'.$query->field_count.'">No records in the table!</td></tr>';
       } ?>
    </table>
    <?php } ?>

   </div>