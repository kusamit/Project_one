<?php
session_start();
include '../dbconnect/dbconnect.php';
$userType= $_SESSION["user_type"];
$user_admin_id=$_SESSION['Login_session'];
echo $userType;
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
<!-- <style>
   .adduser
   {
    background-color:darkblue;
   }
</style> -->
<body>
<?php
if($userType == "admin")
{?>
    <div class="top_nav">
            <!-- <a href="../credentials/logout.php?id=<?php echo $user_admin_id?>" class="top_nav_bar" id="logout">Logout</a> -->
            <?php
            if(!($userType=="user" || $userType=="foreman"))
            {?>
                <a href="../Create/create_project.php" class="top_nav_bar">Project</a>
            <?php
            }?>
            
            <a href="../view/userlist.php" class="top_nav_bar">Users</a>
            <a href="../view/deptlist.php" class="top_nav_bar">Department</a>
            <a href="../interface.php" class="top_nav_bar">Home</a>
            <h2 class="dashboard">Admin</h2>
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

        <!-- Create project -->
        <center><h3>Create New Project</h3></center>
            <div id="project_creation">
                <form action="" method="POST" id="formp" enctype="multipart/form-data">
                    
                    <span>Project Name</span>
                    <span><input type="text" name="project" id="project" required class="p_create"></span>
                    <span>File Type</span>
                    <span><select name="f_type" class="p_create">
                        <option value="1">image</option>
                        <option value="2">pdf</option>
                    </select></span>
                    <span><input type="file" name="file" id="project_file" required class="p_create"></span>
                    <span>Cost</span> <span><input type="number" name="cost" class="p_create"></span>
                    <span>Details</span>
                    <span><textarea name="p_details" id="project" cols="" rows="" class="p_create"></textarea></span><br><br>
                    <span><input type="submit" value="Create" name="submit" id="submit_project" ></span> 
                </form>
            <!-- </div> -->
        <div class="phpproject">
                       <!-- php here -->
                       <?php
                        include '../dbconnect/dbconnect.php';
                        if(isset($_POST["submit"]))
                        {
                            $project_name=$_POST["project"];
                            $file_type=$_POST['f_type'];
                            $project_details=$_POST['p_details'];
                            $cost=$_POST['cost'];
                            // $p_file=$_POST['file'];
                            $file=$_FILES['file']['name'];
                            $temp=$_FILES['file']['tmp_name'];
                            $folder='../project/file/'.$file;
                            move_uploaded_file($temp,$folder);
                            $project_query="INSERT INTO project (project_name,file_type,project_details,cost,file)
                            VALUES ('$project_name','$file_type','$project_details','$cost','$folder')";
                            $result=mysqli_query($conn,$project_query);
                            if($result)
                            {
                               echo "$project_name Project Created Sucessfully...!!";
                            }
                            else
                            {
                                echo "Error to create the Project";
                            }
                        }
                        ?>
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
