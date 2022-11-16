<?php
 include 'connect.php';
// In here, we will need to programatically create the query from user input. This can be done using stirng concatenation and post requests from dropdown selection

  //For now I just have a hardcoded query which displays all of the people currently in users
  $query = mysqli_query($connect, "SELECT * FROM users");

  //We will need to have different types of queries. The first content block below will display all information for all users
  // Maybe try to implement static scrolling table and set the height https://mdbootstrap.com/docs/b4/jquery/tables/scroll/

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
                <a class="nav-item nav-link" href="/final" >Add User</a>      
                <a class="nav-item nav-link" href="/final/addcourse.html" >Add Course</a>
                <a class="nav-item nav-link" href="/final/addenrollment.html" >Add Enrollment</a>
                <a class="nav-item nav-link" href="/final/updatestudent.html">Add/Update student information</a> 
                <a class="nav-item nav-link" href="/final/updateprofessor.html">Add/Update professor information</a> 
                <a class="nav-item nav-link" href="/final/showqueries.php">Query Builder</a>    
            </div>
        </nav>
        <h1> Welcome to the query builder page!</h1>
    <table style="width: auto !important; margin: auto" class="table table-dark">
        <thead> 
            <tr>
                <th scope="col">ID NUMBER</th>
                <th scope="col">FIRST NAME</th>
                <th scope="col">LAST NAME</th>
                <th scope="col">EMAIL</th>
                <th scope="col">AGE</th>
                <th scope="col">IS STUDENT</th>

            </tr>
        </thead>
      <?php while($row = mysqli_fetch_array($query)) { ?>
      <tr>
        <td><?php echo $row['id_number']; ?></td>
        <td><?php echo $row['fname']; ?></td>
        <td><?php echo $row['lname']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['age']; ?></td>
        <td><?php echo $row['is_student']; ?></td>

      </tr>
      <?php } ?>
    </table>

   </div>