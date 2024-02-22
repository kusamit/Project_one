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
        <a style='float:left;' href='../interface.php'>
            <img style=' height:30px; weight:30px;'src='../view/back_button.png'>
        </a>
            <div class="user_creation">
                <form action="" method="POST">
                    <h3>Create User</h3>
                    <span>Full Name</span><span><input type="text" name="name" id="" required></span><br>
                    <span>Email</span><span><input type="email" name="email" id=""></span><br>
                    Phone No.<span><input type="number" name="phone" id=""></span><br>
                    Address<span><input type="text" name="address" id=""></span><br>
                    Username<span><input type="username" name="username" id=""></span><br>
                    Password<span><input type="password" name="password" id=""></span><br>
                    Department<span> 
                        <select name="dept_id" id="">
                            <option value="">Select..</option>
                            <!-- //php for select option department -->
                            <?php
                                include '../dbconnect/dbconnect.php';
                                // $log_id=$login_id;
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
                        
                    </span><br>
                    <!-- for choose the user of manager -->
                    <Span><select name="role" id="">
                        <option value="user">User</option>
                        <option value="foreman">Foreman</option>
                    </select></Span>
                    <span><input type="submit" value="Create" name="submit" id="dpt_smt"></span> 
                    <br><br><br>
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
    </body>
</html>