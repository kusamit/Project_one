<?php
include '../dbconnect/dbconnect.php'; 
session_start();
$userType= $_SESSION["user_type"];
echo $userType;
include '../persistLogin.php';
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
            <a style='float:left;' href='../interface.php'><img style=' height:30px; weight:30px;'src='../view/back_button.png'></a>
            <div class="dpt_creation">
                <form action="" method="POST">
                    <h3>Create New Department</h3>
                    <span><input type="text" name="department" id="dpt" required></span><br>
                    <span><input type="submit" value="Submit" name="submit" id="dpt_smt"></span> 
                    <br><br><br>
                    <div class="phpdepartment">
                       <!-- php here -->
                       <?php
                        if(isset($_POST["submit"]))
                        {
                            $dpt_name=$_POST["department"];
                            $department_query="INSERT INTO department (department_name)
                            VALUES ('$dpt_name')";
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