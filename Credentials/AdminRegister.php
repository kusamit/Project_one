<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Document</title>
    <!-- <link rel="stylesheet" href="../css/admin_register.css"> -->
    <style>
        
    </style>
</head>
<body>
    <div class="main">
        <form action="" method="POST">
            <h1><b>Admin Registration</b></h1> <hr> <br>
            <p>Name</p> <span><input type="text" name="fullname"  placeholder="Enter Your Full Name"></span>
            <p>Organization</p> <span><input type="text" name="org"  placeholder="Enter Phone Number"></span>
            <p>Organization Address</p> <span><input type="text" name="org_address"  placeholder="Enter Your Address"></span>
            <p>Tel. Phone</p> <span><input type="number" name="tel_phone" placeholder="Enter Phone Number"></span>
            <p>Organization Email</p> <span><input type="email" name="org_email"  placeholder="Enter Phone Number"></span>
            <p>Phone No.</p> <span><input type="number" name="phone"  placeholder="Enter Phone Number"></span>
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
    $organization=$_POST['org'];
    $org_address=$_POST['org_address'];
    $telphone=$_POST['tel_phone'];
    $org_email=$_POST['org_email'];
    $phone=$_POST['phone'];
    $username=$_POST['u_name'];
    //encryption password_hash, Password_bcrypt
    $password = password_hash($_POST['password'],PASSWORD_BCRYPT);    



//insert information to table.
    $insertquery="INSERT INTO admin (full_name,organization,org_address,tel_phone,org_email,phone_no,username,password)
    values('$name','$organization','$org_address','$telphone','$org_email','$phone','$username','$password')";
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
