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
            $user_id = $_GET['id'];
            $sql = "SELECT * FROM users WHERE id = '$user_id'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) 
            {
                $user_details = mysqli_fetch_assoc($result);
                $user_department=$user_details['department_id'];
                $dpt="SELECT * from department where dpt_id ='$user_department'";
                $result2 = mysqli_query($conn, $dpt);
                if (mysqli_num_rows($result2) > 0) 
                {
                    $department_details = mysqli_fetch_assoc($result2);
                }
            }
        }
    ?>
        <!-- Update user -->
        <center>
        <h3>Update User</h3>
            <div class="user_creation">
                <form action="" method="POST">
                    
                    <span>Full Name</span><span><input type="text" value='<?php echo $user_details['fullname'] ?>' name="name" id="" class="input_user" required></span>
                    <span>Email</span><span><input type="email" value='<?php echo $user_details['email'] ?>' name="email" id="" class="input_user"></span><br>
                    <span>Phone No.</span><span><input type="number" value='<?php echo $user_details['phone'] ?>' name="phone" id="" class="input_user"></span>
                    <span>Address</span><span><input type="text" value='<?php echo $user_details['address'] ?>' name="address" id="" class="input_user"></span>
                    <!-- <span>Username</span><span><input type="username" name="username" id="" class="input_user"></span>
                    <span>Password</span><span><input type="password"  name="password" id="" class="input_user" required></span> -->
                    <!-- <span>Department</span>
                    <span> 
                        <select name="dept_id" id="" class="input_user">
                            <option value=''><?php echo $department_details['department_name'] ?></option>
                            //php for select option department -->
                            <?php
                                $sql="SELECT * from department";
                                $result=mysqli_query($conn,$sql);
                                if($result)
                                {
                                    // echo "";
                                }else
                                {
                                    // echo "error to Find Department";
                                }
                                $num=mysqli_num_rows($result);
                                if ($num>0) 
                                {
                                    while ($row = mysqli_fetch_assoc($result)) 
                                    {
                                        ?>
                                        <!-- <option value="<?php echo $row['dpt_id']?>"><?php echo $row['department_name']?></option>; -->
                                        <?php
                                    }
                                } 
                                else 
                                {
                                    // echo "<option value=''>Create a department first</option>";
                                }
                            ?>
                        <!-- </select> -->
                        
                    </span>
                    <!-- for choose the user of manager -->
                    <!-- <span>Role</span>
                    <Span><select name="role" id="" class="input_user">
                        <option value="user">User</option>
                        <option value="foreman">Foreman</option>
                    </select></Span> -->
                    <span><input type="submit" value="Update" name="submit" id="submit_user"></span> 
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
                            // $username=$_POST["username"];
                            //encryption password_hash, Password_bcrypt
                            // $password = password_hash($_POST['password'],PASSWORD_BCRYPT);  
                            // $department=$_POST["dept_id"];
                            // $user_role=$_POST["role"];
                            $update_user = "UPDATE users SET fullname='$name', email='$email', phone='$phone', address='$address' WHERE id='$user_id'";
                            $result=mysqli_query($conn,$update_user);
                            if($result)
                            {
                               echo "User Updated Sucessfully...!!";
                            // header('Location: ../View/userlist.php');

                            }
                            else
                            {
                                echo "Error to Update the user, Please try again later...!";
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
