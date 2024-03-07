<?php
include '../dbconnect/dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<style>

    </style>
<body>
    <center>
    <div class='form'>
    <form action="" method="POST">
        <h1>LogIn | PMS</h1>
       <label for="">Username</label>
       <label for=""><input type="text" name="username" id=""></label>
        <label for="">Password</label>
        <label for=""><input type="password" name="password" id=""></label>
        <label for="">UserType</label>
        <label for="">
        <select name="authentication" id="">
            <option value="1" >Admin</option>
            <!-- <option value="2">Foreman</option> -->
            <option value="2">User</option>
        </select>
        </label>
        <input type="submit" value="login" name="login" id="sbmt_login">
        
    </form>
    <!-- </center> -->
    <?php
            if(isset($_POST['login']))
            {
                $authentication=$_POST['authentication'];
                $username=$_POST['username'];
                $password=$_POST['password'];
                if($authentication==1)
                {
                    $admin_name = mysqli_real_escape_string($conn, $_POST['username']);
                    $query_admin = "SELECT * FROM admin WHERE username = '$admin_name'";
                    $result_admin = mysqli_query($conn, $query_admin);
                    $num_admin = mysqli_num_rows($result_admin);
                        if ($num_admin > 0) {
                            $data_admin = mysqli_fetch_array($result_admin);
                            $db_id_admin = $data_admin['id'];
                            $db_username_admin = $data_admin['username'];
                            $db_password_admin = $data_admin['password']; // it is in hash form
                            if (password_verify($password, $db_password_admin) && $db_username_admin == $admin_name)
                            {
                                session_start();
                                $_SESSION['Login_session'] = $db_id_admin;
                                $_SESSION["user_type"] = "admin";
                                $_SESSION['login'] = true;
                                header('location:../interface.php');
                                exit();
                            } 
                            else 
                            {
                                echo "Invalid Admin Username or Password";
                            }
                        } 
                        else 
                        {
                            echo "Please Enter Your Username and Password";
                        }
                }
                if($authentication==2)
                {
                    $username = mysqli_real_escape_string($conn, $_POST['username']);
                    $query_username = "SELECT * FROM users WHERE username = '$username'";
                    $result_username = mysqli_query($conn, $query_username);
                    $num_username = mysqli_num_rows($result_username);
                        if ($num_username > 0) {
                            $data_user = mysqli_fetch_assoc($result_username);
                            $db_user_id = $data_user['id'];
                            $db_user_role = $data_user['role'];
                            $db_username_user = $data_user['username'];


                            $db_password_user = $data_user['password']; // it is in hash form
                            if (password_verify($password, $db_password_user))
                            {
                                session_start();
                                $_SESSION['Login_session'] = $db_user_id;
                                if($db_user_role == "foreman"){
                                    $_SESSION['user_type'] = $db_user_role;
                                    $_SESSION['login'] = true;
                                    echo $db_user_role;
                                 header('location:../interface.php');
                                }else if($db_user_role == "user"){
                                    $_SESSION['user_type'] = $db_user_role;
                                    echo $db_user_role;
                                    $_SESSION['login'] = true;
                                     header('location:../interface.php');
                                }
                               
                                
                              
                                exit();
                            } 
                            else 
                            {
                                echo "Invalid  Username or Password";
                            }
                        } 
                        else 
                        {
                            echo "Please Enter Your Username and Password";
                        }
                }
            }
        ?>
        </center> 
    </div>
</body>
</html>
