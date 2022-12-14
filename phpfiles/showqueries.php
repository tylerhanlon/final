<?php
 include 'connect.php';
  //Will display the returned table from any query a user can enter

  //Below retrieves and checks inputted query. It will display an error if the inputted query is incorrect, or it will display the 
  //proper returned table


  //Why is the below query messed up when you run it on the site? It gives duplicate vals im not sure why
  //select professors.id_number, fname, lname, email, courses.course_id, courses.course_name, semester, year, course_credits from users inner join professors on users.id_number = professors.id_number inner join teaches on professors.id_number = teaches.id_number inner join courses on teaches.course_id = courses.course_id

  $exception = false;

  if(isset($_POST['input']))
  {
    $input = $_POST['input'];
    
    if(!empty($input)){

      try {
        $query = mysqli_query($connect, $input);
        $data = $query->fetch_all(MYSQLI_ASSOC);
        $exception = true;
      } catch (mysqli_sql_exception $e) {
        echo "Invalid query, please try again";
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

<title> Query Builder</title>
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
                <a class="nav-item nav-link" href="/final/phpfiles/admin.php"> Admin Tools</a>
            </div>
        </nav> 

<h1> Welcome to the Query Search page!</h1>
    <div class="row">
    <div class="col-lg-4 col-lg-offset-4">
      <form action="showqueries.php" method="post">
          <div>
            <label for="input">Enter a custom query here!</label>
            <input type="text" id="input" class="form-control" name="input" />
          </div>
          <input type="submit" class="btn btn-primary justify-content-center" style="margin-top: 5px"/>
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