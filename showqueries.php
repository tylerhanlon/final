<?php
  $hostname = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'final';


    //Should probably put this into a try/catch block in case db gets nuked
    //Also this connection is redundant, we dont need to include it.
    //Going to remove once we know everything is working 
    
  $connection = new mysqli('localhost', 'root', '', 'final');

  $query = mysqli_query($connection, "SELECT * FROM user");
  

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