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
    <link rel="stylesheet" href="../css/project.css">

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
                        </center>
            <div class="dpt_creation">
                <center>
                <form action="" method="POST">
                    <span class="padd">Department Name</span>
                    <span><input type="text" name="department"  required class="d_create" class="padd" placeholder="Enter Department Name"></span>
                    <span><input type="submit" value="Submit" name="submit"  class="padd" ></span> 
                </form>
                </center>
                <div class="phpdepartment">
                       <!-- php here -->
                       <?php
if(isset($_POST["submit"])) {
    $dpt_name = $_POST["department"];
    $check_department = "SELECT * FROM department WHERE department_name='$dpt_name'";
    $check_result = mysqli_query($conn, $check_department);
    
    if(mysqli_num_rows($check_result) > 0) {
        // Department already exists
        echo "<script>
                alert('The entered department already exists!');
            </script>";
    } else {
        // Department does not exist, proceed to insert
        $department_query = "INSERT INTO department (department_name) VALUES ('$dpt_name')";
        $add_result = mysqli_query($conn, $department_query);
        if($add_result) {
            // Department added successfully
            echo "<script>
                alert('Department has been created successfully');
                window.location.href = '../view/deptlist.php';
            </script>";
            exit;
        } else {
            // Error adding department
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

                    </div>
            </div>
        <!-- </center> -->

            <?php
            }?>
                
            </div>
<?php        
}?>
</body>
</html>
