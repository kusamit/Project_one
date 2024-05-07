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
    <link rel="stylesheet" href="../css/passchange.css">
</head>
<body>
    <?php
    if($userType=='admin')
    {
        include '../interface_nav.php';
        if (isset($_GET['uid'])) 
        {
            $user_id = $_GET['uid'];
        }
            $sql = "SELECT * FROM users WHERE id = '$user_id'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) 
            {
                $user_details = mysqli_fetch_assoc($result);
                $user_department=$user_details['department_id'];
                $dpt="SELECT * from department where dpt_id ='$user_department'";
            }
    ?>
        <div class='pass_change'>
            <form action="" method ='POST'>
                Name: <?php echo $user_details['fullname'];?> <hr><br>
                <span>Create New Password</span>
                <span><input type="password" name='newpass' class='newpassinput'></span>
                <input type="submit" name='change' value="Change" class="new_password">
            </form>
        </div>
    <?php
    if (isset($_POST["change"]))
    {
        $user_id = $_GET['uid'];
        $changepass=password_hash($_POST['newpass'],PASSWORD_BCRYPT);
        $sql = "UPDATE users set password='$changepass' where id='$user_id'";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            echo "Password Changed Successfully.";
        }
        else
        {
            echo "Error to change password.";
        }
    }
}
else
{
    echo "Access forbidden.";
}
    ?>
</body>
</html>