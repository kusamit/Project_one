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
    <title>User</title>
    <link rel="stylesheet" href="../css/interface.css">
    <link rel="stylesheet" href="../css/head_nav.css">
    <link rel="stylesheet" href="../css/user.css">
</head>
<body>
<?php
if($userType == "admin" || $userType == "foreman")
{?>
    <?php 
        include '../interface_nav.php'; //top nav
    ?>
        <!-- Create user -->
        <center>
        <h3>Create User</h3>
        <div class="form_container">
            <div class="user_creation">
                <form action="" method="POST">
                    <span>Full Name</span><input type="text" name="name" id="" class="input_user" required>
                    <span>Email</span><input type="email" name="email" id="" class="input_user">
                    <span>Phone No.</span><input type="number" name="phone" id="" class="input_user">
                    <span>Address</span><input type="text" name="address" id="" class="input_user">
                    <span>Username</span><input type="username" name="username" id="" class="input_user">
                    <span>Password</span><input type="password" name="password" id="" class="input_user" required>
                    <span>Department</span>
                    <select name="dept_id" id="" class="input_user" required>
                        <option value="">Select..</option>
                        <!-- PHP for select option department -->
                        <?php
                        $sql="SELECT * from department";
                        $result=mysqli_query($conn,$sql);
                        if($result) {
                            echo "";
                        } else {
                            echo "error to Create department";
                        }
                        $num=mysqli_num_rows($result);
                        if ($num>0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <option value="<?php echo $row['dpt_id']?>"><?php echo $row['department_name']?></option>;
                                <?php
                            }
                        } else {
                            echo "<option value=''>Create a department first</option>";
                        }
                        ?>
                    </select>
                    
                    <span>Role</span>
                    <select name="role" id="" class="input_user" required>
                        <option value="user">User</option>
                        <option value="foreman">Foreman</option>
                    </select>
                    
                    <input type="submit" value="Add" name="submit" id="submit_user" class="submit_button">
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
                            $checkusername="SELECT username from users where username='$username'";
                            $checkresult=mysqli_query($conn,$checkusername);
                            if(mysqli_num_rows( $checkresult)> 0)
                            {
                                echo "<script>
                            alert('Username Already Exists. Please Use another Username');
                            </script>"; 
                                // echo "Username Already Exists. Please Use another Username";
                            }
                            else
                            {
                            $create_user="INSERT INTO users (fullname,email,phone,address,username,password,department_id,role)
                            VALUES ('$name','$email','$phone','$address','$username','$password','$department','$user_role')";
                            $result=mysqli_query($conn,$create_user);
                            if($result)
                            {
                            //    echo "User Created Sucessfully...!!";
                            echo "<script>
                            alert('User has been created successfully');
                            </script>";
                            header("Refresh:0;url='../View/userlist.php'");
                            // window.location.href = '../View/userlist.php';
                            // header('Location: ../View/userlist.php');

                            }
                            else
                            {
                                echo "<script>
                            alert('Error to create the user, Please try again later...!');
                            </script>";   
                                // echo "Error to create the user, Please try again later...!";
                            }
                            }
                        }
                    ?>
                </div> 
            </div>
        </div>
    </center>
    

<?php        
}
else
{
    echo "Access Forbidden";
}
?>

</body>
</html>
