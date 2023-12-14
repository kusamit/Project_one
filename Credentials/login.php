
<html>
    <head>
        <title>User Login</title>
        <link rel="stylesheet" href="../css/login.css">
    </head>
    
    <body>
        <div class="outer">
            <div class="userlogin">
                <form action="" method="POST">
                    <h2>LOGIN</h2> 
                    <hr><br>
                    <img src="3.png" alt="User">
                    <br>
                    Email or Username
                     <br> <input type="text" name="username" placeholder="Enter your Username">
                    <br>
                    Password  <br> <input type="password" name="password" placeholder="Enter your Password">
                    <select name="auth" id="selection">
                        <option value="0">Admin</option>
                        <option value="1" >User</option>
                        <option value="2" >Manager</option>
                    </select>
                    <input type="submit" value="Login" name="submit" id="submit_login">
                
                  
                    
                </form>
                <?php
                include '../dbconnect/dbconnect.php';
                           if(isset($_POST['submit']))
                           {
                                $name = $_POST['username'];
                                
                            // $password =  md5($_POST['password']);       //encryption md5
                            $password =($_POST['password']);               //encryption password_hash, Password_bcrypt
                                $auth = $_POST['auth'];
                                session_start();
                                
                                if($auth == 0)
                                {
                                        $query_admin = "select * from admin_registration where username = '$name' ";
                                        $result=mysqli_query($conn,$query_admin);
                                       
                                        $num_a=mysqli_num_rows($result);
                                        while($data = mysqli_fetch_array($result)){
                                            $db_id=$data['id'];
                                            $db_username = $data['username'];
                                            $db_password = $data['password']; // it is in hash form
                                        }
                                        // if($db_password ==$password && $db_username == $name){
                                        if(password_verify($password, $db_password) && $db_username == $name){

                                        
 
                                            $_SESSION['Login_session']= $db_id;
                                            echo "Admin Login Sucess";
                                            header('location:../mainsession.php');
                                        }
                                        else{
                                            echo "Invalid Admin Username or Password";
                                        }

                                }
                                if($auth == 1)
                                {
                                        $query_user = "select * from user where username = '$name' ";
                                        $result=mysqli_query($conn,$query_user);
                                       
                                        $num_a=mysqli_num_rows($result);
                                        while($data = mysqli_fetch_array($result)){
                                            $db_id=$data('id');
                                            $db_username = $data['username'];
                                            $db_password = $data['password']; // it is in hash form
                                        }
                                        if(password_verify($password, $db_password) && $db_username == $name)
                                        {
                                            $_SESSION['Login_session']= $db_id;
                                            echo "Admin Login Sucess";
                                            header('location:../mainsession.php');
                                        }
                                        else{
                                            echo "Invalid Admin Username or Password";
                                        }

                                }
                                if($auth == 2)
                                {
                                        $query_user = "select * from manager where username = '$name' ";
                                        $result=mysqli_query($conn,$query_user);
                                       
                                        $num_a=mysqli_num_rows($result);
                                        while($data = mysqli_fetch_array($result)){
                                            $db_id=$data('id');
                                            $db_username = $data['username'];
                                            $db_password = $data['password']; // it is in hash form
                                        }
                                        if(password_verify($password, $db_password) && $db_username == $name)
                                        {
                                            $_SESSION['Login_session']= $db_id;
                                            echo "Admin Login Sucess";
                                            header('location:../mainsession.php');
                                        }
                                        else{
                                            echo "Invalid Admin Username or Password";
                                        }

                                }
                            }
                    ?>
                <br><br>
                <h5>Please use your credentials to login.</h5>
            </div>
            <div class="usersignup">
                <br><br><br><br><br><br>
                <img src="3.png" alt="User">
                <h3>If You don't have Any Account?</h3>
                <h4>Register Now</h4>
                <button>
                    <a href="AdminRegister.php">Register</a>
                </button>
            </div>
        </div>    
    </body>
</html>