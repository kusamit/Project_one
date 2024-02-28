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

        <!-- Create user -->
        <center>
        <!-- <a style='float:left;' href='../interface.php'>
            <img style=' height:30px; weight:30px;'src='../view/back_button.png'>
        </a> -->
        <h3>Create User</h3>
            <div class="user_creation">
                <form action="" method="POST">
                    
                    <span>Full Name</span><span><input type="text" name="name" id="" class="input_user" required></span>
                    <span>Email</span><span><input type="email" name="email" id="" class="input_user"></span>
                    <span>Phone No.</span><span><input type="number" name="phone" id="" class="input_user"></span>
                    <span>Address</span><span><input type="text" name="address" id="" class="input_user"></span>
                    <span>Username</span><span><input type="username" name="username" id="" class="input_user"></span>
                    <span>Password</span><span><input type="password" name="password" id="" class="input_user"></span>
                    <span>Department</span>
                    <span> 
                        <select name="dept_id" id="" class="input_user">
                            <option value="">Select..</option>
                            <!-- //php for select option department -->
                            <?php
                                $sql="SELECT * from department";
                                $result=mysqli_query($conn,$sql);
                                if($result)
                                {
                                    echo "";
                                }else
                                {
                                    echo "error to Create department";
                                }
                                $num=mysqli_num_rows($result);
                                if ($num>0) 
                                {
                                    while ($row = mysqli_fetch_assoc($result)) 
                                    {
                                        ?>
                                        <option value="<?php echo $row['dpt_id']?>"><?php echo $row['department_name']?></option>;
                                        <?php
                                    }
                                } 
                                else 
                                {
                                    echo "<option value=''>Create a department first</option>";
                                }
                            ?>
                        </select>
                        
                    </span>
                    <!-- for choose the user of manager -->
                    <span>Role</span>
                    <Span><select name="role" id="" class="input_user">
                        <option value="user">User</option>
                        <option value="foreman">Foreman</option>
                    </select></Span>
                    <span><input type="submit" value="Create" name="submit" id="submit_user"></span> 
                </form>
                <div class="phpdepartment">
                       <!-- php here -->
                       <?php
                        
                        if(isset($_POST["submit"]))
                        {
                            $name=$_POST["name"];
                            $email=$_POST["email"];
                            $phone=$_POST["phone"];
                            $address=$_POST["address"];
                            $username=$_POST["username"];
                            //encryption password_hash, Password_bcrypt
                            $password = password_hash($_POST['password'],PASSWORD_BCRYPT);  
                            $department=$_POST["dept_id"];
                            $user_role=$_POST["role"];
                            $create_user="INSERT INTO users (fullname,email,phone,address,username,password,department_id,role)
                            VALUES ('$name','$email','$phone','$address','$username','$password','$department','$user_role')";
                            $result=mysqli_query($conn,$create_user);
                            if($result)
                            {
                               echo "User Created Sucessfully...!!";
                            }
                            else
                            {
                                echo "Error to create the user, Please try again later...!";
                            }
                        }
                    ?>
                </div> 
            </div>
        </center>

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
