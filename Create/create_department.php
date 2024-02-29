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
<style>
   .adduser
   {
    background-color:darkblue;
   }
</style>
<body>
<?php
if($userType == "admin" || $userType == "foreman" || $userType == "user")
{?>
    <div class="top_nav">
            <!-- <a href="../credentials/logout.php?id=<?php echo $user_admin_id?>" class="top_nav_bar" id="logout">Logout</a> -->
            <?php
            if(!($userType=="user" || $userType=="foreman"))
            {?>
                <a href="../Create/create_project.php" class="top_nav_bar">Create Project</a>
            <?php
            }?>
            
            <a href="../view/userlist.php" class="top_nav_bar">Users</a>
            <a href="../view/deptlist.php" class="top_nav_bar">Department</a>
            <a href="../interface.php" class="top_nav_bar">Home</a>
            <?php
            if($userType=="admin")
            {?>
                <h2 class="dashboard">Admin</h2>
            <?php
            }?><?php
            if($userType=="foreman")
            {?>
                <h2 class="dashboard">Foreman</h2>
            <?php
            }?><?php
            if($userType=="user")
            {?>
                <h2 class="dashboard">User</h2>
            <?php
            }?>
        </div>
        <div class="head">
            <h1>Project Management System</h1>
        </div>
        <?php
        if($userType=="admin")
        {
            $admin_id = mysqli_real_escape_string($conn, $user_admin_id);

            $admin_name_query = "SELECT * FROM admin WHERE id = '$admin_id'";
            $result_admin_name = mysqli_query($conn, $admin_name_query);
            $num_admin = mysqli_num_rows($result_admin_name);
            // Check if at least one row is returned
            if ($num_admin > 0) 
            {
                $admin_row = mysqli_fetch_array($result_admin_name);
                $admin_name = $admin_row['username'];
            } 
            else 
            {
                $db_name = "Unknown Admin";
            }
        ?>
        <div class="nav">
            <h2 class="admin_name"><?php echo $admin_name;?><br><?php echo "Username"; ?></h2>
        </div>
        <?php
        }
        elseif($userType=="foreman")
        {
            $foreman_id = mysqli_real_escape_string($conn, $user_admin_id);
            $foreman_name_query = "SELECT * FROM users WHERE id = '$foreman_id'";
            $result_foreman_name = mysqli_query($conn, $foreman_name_query);
            $num_foreman = mysqli_num_rows($result_foreman_name);
            if ($num_foreman > 0) 
            {
                $foreman_row = mysqli_fetch_array($result_foreman_name);
                $foreman_name = $foreman_row['username'];
            } 
            else 
            {
                $db_name = "Unknown Admin";
            }
        ?>

        <div class="nav">
            <h2 class="foreman_name"><?php echo $foreman_name;?><br><?php echo "Username"; ?></h2>
        </div>
        <?php
        }
        elseif($userType=="user")
        {
            $user_id = mysqli_real_escape_string($conn, $user_admin_id);
            $user_name_query = "SELECT * FROM users WHERE id = '$user_id'";
            $result_user_name = mysqli_query($conn, $user_name_query);
            $num_user = mysqli_num_rows($result_user_name);
            if ($num_user > 0) 
            {
                $user_row = mysqli_fetch_array($result_user_name);
                $user_name = $user_row['username'];
            } 
            else 
            {
                $db_name = "Unknown Admin";
            }
        ?>
            <div class="nav">
             <h2 class="foreman_name"><?php echo $user_name;?><br><?php echo "Username"; ?></h2>
            </div>
        <?php
        }?>
        
            

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
                               echo "$dpt_name Department Created Sucessfully...!!";
                            // header('location:../view/deptlist.php');
                            }
                            else
                            {
                                echo "Error to create the Department";
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
