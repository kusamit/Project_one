<?php
include 'session_create.php';
?>
<html>
    <head>
        <title>
            Department
        </title>
        <link rel="stylesheet" href="../css/creation.css">
    </head>
    <body>
    <div class="head">
            <h1>Project Management System</h1>
        </div>
        <div class="nav">

        </div>
        <center>
            <div class="dpt_creation">
                <form action="" method="POST">
                    <h3>Create New Department</h3>
                    <span><input type="text" name="department" id="dpt" required></span><br>
                    <span><input type="submit" value="Submit" name="submit" id="dpt_smt"></span> 
                    <br><br><br>
                    <div class="phpdepartment">
                       <!-- php here -->
                       <?php
                        include '../dbconnect/dbconnect.php';
                        if(isset($_POST["submit"]))
                        {
                            $log_id=$login_id;
                            $dpt_name=$_POST["department"];
                            $department_query="INSERT INTO department (department_name,log_id)
                            VALUES ('$dpt_name','$log_id')";
                            $result=mysqli_query($conn,$department_query);
                            if($result)
                            {
                               echo "$dpt_name Department Created Sucessfully...!!";
                            }
                            else
                            {
                                echo "Error to create the Department";
                            }
                        }
                        ?>
                    </div>
                </form>
                    
            </div>
        </center>
        
    </body>
</html>