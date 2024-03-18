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
if($userType == "admin")
{?>
    <?php 
        include '../interface_nav.php'; //top nav
    ?>
    <!-- fetch user details -->
    <?php
                if (isset($_GET['id'])) 
                {
                    $dept_id = $_GET['id'];

                    $sql = "SELECT * FROM department WHERE dpt_id = '$dept_id'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        $dept = mysqli_fetch_assoc($result);
                        $fetched_dept_id = $dept["dpt_id"];
                        // echo $fetched_dept_id;
                        $dept_name=$dept["department_name"];
                        // echo "$dept_name";
                    }
                }
    ?>
        <!-- Update user -->
        <div class="outer">
                <?php
                if($userType=="admin")
                {?>
                    <center>
                        <h3>Update Department</h3>
            <div class="dpt_creation">
                <form action="" method="POST">
                    <span class="padd">Department Name</span>
                    <span><input type="text" value="<?php echo $dept_name ?>"  name="department"  required class="d_create" class="padd" placeholder="Enter Department Name"></span>
                    <span><input type="submit" value="Update" name="update" id="submit_department" class="padd" ></span> 
                </form>
                <div class="phpdepartment">
                       <!-- php here -->
                       <?php
                        if(isset($_POST["update"]))
                        {
                            $dpt_name=$_POST["department"];
                            $department_query="UPDATE department set department_name='$dpt_name' where dpt_id='$fetched_dept_id'";
                            $result=mysqli_query($conn,$department_query);
                            if($result)
                            {
                               echo "$dpt_name Department Updated Sucessfully...!!";
                            // header('location:../view/deptlist.php');
                            }
                            else
                            {
                                echo "<h6> Error to update the Department</h6>";
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
    </div>

<?php        
}
else
{
    echo "Access Forbidden";
}
?>

</body>
</html>
