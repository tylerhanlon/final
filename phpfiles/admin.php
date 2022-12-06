<?php

include 'connect.php';

$exception = false;


//Tries to run alter form
if (isset($_POST['attribute']) && isset($_POST['altertablename'])){
    $attribute = $_POST['attribute'];
    $tablename = $_POST['altertablename'];

    //attempt to run alter statement here
    $stmt = "ALTER TABLE $tablename ADD COLUMN $attribute varchar(60)";
    try{
    $query = mysqli_query($connect, $stmt);
    echo 'Administrator command run successfully';
    header("Location:showqueries.php");
    } catch (mysqli_sql_exception $e){
        echo "Unable to add attribute. Please check your arguments and try again";
    }
//Tries to run remove record form
} else if(isset($_POST['remtablename']) && isset($_POST['remkey']) && isset($_POST['pkeyname'])){
    $remtable = $_POST['remtablename'];
    $remkey = $_POST['remkey'];
    $pkeyname = $_POST['pkeyname'];

    $stmt = "DELETE FROM $remtable WHERE $pkeyname = $remkey";

    try{
    $query = mysqli_query($connect, $stmt);
    echo 'Administrator command run successfully';
    header("Location:showqueries.php");
    } catch (mysqli_sql_exception $e){
        echo "Invalid Primary Key Name or Attribute Value";
    }
//Tries to run drop table, exists w/ exception if foreign key check fails
} else if(isset($_POST['droptablename'])){
    $droptablename = $_POST['droptablename'];

    $stmt = "DROP TABLE IF EXISTS $droptablename";
    try{
    $query = mysqli_query($connect, $stmt);
    echo 'Administrator command run successfully';
    header("Location:showqueries.php");
    } catch (mysqli_sql_exception $e){
        echo "Unable to drop table due to a failed foreign key check";
    }

} 

?>


<div id="content">

    <head>
    <title>Admin Tools</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<style>
    body {background-color: lightblue;}
    h1 {text-align: center;}
    #desc {text-align: center;}
</style>
</head>

            <!-- This must be on the top of every visible page. It is the nav bar with form options so navigation is easier-->
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
            <h1>Administrator Actions  </h1>


    <div class="text-center">
        <form action="admin.php" method="post">
            <div class="row justify-content-center" style="width: 20%; margin: auto;">
                <button type="submit" class="btn btn-success" name="alter" style="margin-top: 5px; font-size: 14.3px">Alter a table</button>
</div>
<div class="row justify-content-center" style="width: 20%; margin: auto;">
                <button type="submit" class="btn btn-success" name="rem_rec" style="margin-top: 5px; font-size: 14.3px">Remove a record</button>
</div>
                <div class="row justify-content-center" style="width: 20%; margin: auto;">
                <button type="submit" class="btn btn-success" name="rem_tab" style="margin-top: 5px; font-size: 14.3px">Remove a table</button>
</div>
            </form>

        <?php if(isset($_POST['alter'])){
            echo         '<div class="row justify-content-center">
            <div class="card w-25">
                <div class="card-header">
                    Please fill out the form below to add a field to a table
                </div>
                <div class="card-body">
                    <form action="/final/phpfiles/admin.php" method="post">
                        <div class="form-group">

                            <label for="altertablename">Table name</label>
                            <input type="text" id="altertablename" class="form-control" name="altertablename"/>  

                            <label for="field">Attribute name to be added (string only)</label>
                            <input type="text" id="attribute" class="form-control" name="attribute" />
                            
                        </div>
                        <div class="col-sm">
                        <input type="submit" class="btn btn-primary justify-content-center" style="margin-top: 5px"/>
                    </div>
                    </form>
                </div>
                <div class="card-footer">
                    <small>Tyler Hanlon, Rush Daruwalla, Rohan Kelley</small>
                </div>
            </div>
        </div>';


        } else if(isset($_POST['rem_rec'])){
            echo         '<div class="row justify-content-center">
            <div class="card w-25">
                <div class="card-header">
                    Please fill out the form below to remove a specific record from a table
                </div>
                <div class="card-body">
                    <form action="/final/phpfiles/admin.php" method="post">
                        <div class="form-group">

                            <label for="remtablename">Table name</label>
                            <input type="text" id="remtablename" class="form-control" name="remtablename"/>  

                            <label for="field">Primary Key Identifier for Table</label>
                            <input type="text" id="pkeyname" class="form-control" name="pkeyname" />

                            <label for="field">Primary key of record to be removed</label>
                            <input type="text" id="remkey" class="form-control" name="remkey" />
                            
                        </div>
                        <div class="col-sm">
                        <input type="submit" class="btn btn-primary justify-content-center" style="margin-top: 5px"/>
                    </div>
                    </form>
                </div>
                <div class="card-footer">
                    <small>Tyler Hanlon, Rush Daruwalla, Rohan Kelley</small>
                </div>
            </div>
        </div>';
        } else if(isset($_POST['rem_tab'])){
            echo         '<div class="row justify-content-center">
            <div class="card w-25">
                <div class="card-header">
                    Enter the name of the table you would like to drop 
                </div>
                <div class="card-body">
                    <form action="/final/phpfiles/admin.php" method="post">
                        <div class="form-group">

                            <label for="droptablename">Table name</label>
                            <input type="text" id="droptablename" class="form-control" name="droptablename"/>  

                        </div>
                        <div class="col-sm">
                        <input type="submit" class="btn btn-primary justify-content-center" style="margin-top: 5px"/>
                    </div>
                    </form>
                </div>
                <div class="card-footer">
                    <small>Tyler Hanlon, Rush Daruwalla, Rohan Kelley</small>
                </div>
            </div>
        </div>';
        }  
        ?>
    </div>
</div>


