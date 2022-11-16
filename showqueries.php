<?php
 include 'connect.php';
// In here, we will need to programatically create the query from user input. This can be done using stirng concatenation and post requests from dropdown selection

  //For now I just have a hardcoded query which displays all of the people currently in users
  $query = mysqli_query($connect, "SELECT * FROM users");

?>

  <div id="content">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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