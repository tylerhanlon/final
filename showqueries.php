<?php
 include 'connect.php';

  $query = mysqli_query($connect, "SELECT * FROM users");


?>



  <div id="content">

    <table class="table table-dark">
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