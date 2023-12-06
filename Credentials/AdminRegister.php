<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin_register.css">
    <style>
        
    </style>
</head>
<body>
    <div class="main">
        <form action="" method="POST">
            <h1><b>Admin Registration</b></h1> <hr> <br>
            <p>Name</p> <span><input type="text" name="fullname" required placeholder="Enter Your Full Name"></span>
            <p>Address</p> <span><input type="text" name="address" required placeholder="Enter Your Address"></span>
            <p>Phone No.</p> <span><input type="number" name="phone" required placeholder="Enter Phone Number"></span>
            <p>Email</p> <span><input type="email" name="email" required placeholder="Enter Phone Number"></span>
            <p>Username</p> <span><input type="text" name="u_name" placeholder="Enter Your Username" required></span>
            <p>Password</p><span><input type="password" name="password" placeholder="Enter Your Password"required></span>
            <input type="submit" value="Submit" name="submit" style="background-color:blue; color:white; font-size:25px;
            width:10rem; margin-left:10px; margin-buttom:20px;"> 
            <br>
<div class="php">
<?php
include '../dbconnect/dbconnect.php';

if(isset($_POST["submit"]))
{
    $name=$_POST['fullname'];
    $address=$_POST['address'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $username=$_POST['u_name'];
    $password=$_POST['password'];



//insert information to table.
    $insertquery="INSERT INTO admin_registration (full_name,address,phone,email,username,password)
    values('$name','$address','$phone','$email','$username','$password')";
    $insertinfo=mysqli_query($conn,$insertquery);
    if($insertinfo)
    {
        echo "Registration Sucessful..!";
        
    }
    else{
        echo" Error In Registration";
    }
}
?></div>
        </form>
    </div>
</body>
</html>
