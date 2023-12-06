<?php
include 'session_create.php';
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
            <div class="dpt_creation">
                <form action="" method="POST">
                    <h3>Create User</h3>
                    Full Name<span><input type="text" name="name" id="" required></span><br>
                    Email<span><input type="email" name="email" id=""></span><br>
                    Phone No.<span><input type="number" name="phone" id=""></span><br>
                    Address<span><input type="text" name="address" id=""></span><br>
                    Username<span><input type="username" name="username" id=""></span><br>
                    Password<span><input type="password" name="password" id=""></span><br>
                    Department<span> 
                        <select name="dept_id" id="">
                            <option value="">Select..</option><?php
                                $sql="SELECT * from department";
                                $result=mysqli_query($conn,$sql);
                                if($result)
                                {
                                    echo "";
                                }else
                                {
                                    echo "error to get department";
                                }
                                if ($result->num_rows > 0) 
                                {
                                    while ($row = $result->fetch_assoc()) 
                                    {
                                        echo "<option value='" . $row["id"] . "'>" . $row["department_name"] .  "</option>";
                                    }
                                } 
                                else 
                                {
                                    echo "<option value=''>Create a department first</option>";
                                }
                                    
                                    ?>
                        </select>
                        
                    </span>
                    <span><input type="submit" value="Create" name="submit" id="dpt_smt"></span> 
                    <br><br><br>
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
                            $password=$_POST["password"];
                            $department=$_POST["dept_id"];
                            $create_user="INSERT INTO user (fullname,email,phone,address,username,password,department_id)
                            VALUES ('$name','$email','$phone','$address','$username','$password','$department')";
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
                </form>
                    
            </div>
        </center>
        
    </body>
</html>