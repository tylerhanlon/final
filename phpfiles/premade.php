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
} //add more here

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
    <div class="col-lg-10 col-lg-offset-4">
      <form action="premade.php" method="post">
          <div>
                <button type="submit" class="btn btn-success" name="AGPC" style="margin-top: 5px;">Average Grade Per Course</button>
                <button type="submit" class="btn btn-success" name="classes" style="margin-top: 5px;">List All CS Classes</button>
                <button type="submit" class="btn btn-success" name="active" style="margin-top: 5px;">Active Professors in 2022</button>
                <button type="submit" class="btn btn-success" name="input4" style="margin-top: 5px;">Input4</button>
          </div>
      </form>
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