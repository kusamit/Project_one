<?php
session_start();
include '../dbconnect/dbconnect.php';
$userType= $_SESSION["user_type"];
$user_admin_id=$_SESSION['Login_session'];
// echo $userType;
include '../persistLogin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/interface.css">
</head>
<body>
<?php
if($userType == "admin" || $userType == "foreman" || $userType == "user")
{?>
    <?php 
        include '../interface_nav.php'; //top nav
    ?>
    <!-- Department Creation -->
    <div class="outer">
                <?php
                if($userType=="admin")
                {?>
                    <center>
                        <h3>Create New Department</h3>
            <!-- <a style='float:left;' href='../interface.php'><img style=' height:30px; weight:30px;'src='../view/back_button.png'></a> -->
            <div class="dpt_creation">
                <form action="" method="POST">
                    <span class="padd">Department Name</span>
                    <span><input type="text" name="department"  required class="d_create" class="padd" placeholder="Enter Department Name"></span>
                    <span><input type="submit" value="Submit" name="submit" id="submit_department" class="padd" ></span> 
                </form>
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
                            //    echo "$dpt_name Department Created Sucessfully...!!";
                            header('location:../view/deptlist.php');
                            }
                            else
                            {
                                echo "<h6> Error to create the Department</h6>";
                            }
                        }
                        ?>
                    </div>
            </div>
        </center>

            <?php
            }?>
                
            </div>

        
        <div class="footer">
            <!-- Project Management System -->
        </div>
<?php        
}?>
</body>
</html>
