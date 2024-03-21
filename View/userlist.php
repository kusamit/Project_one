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
<style>
    table{
        border-collapse: collapse;
        border-radius: 5px;
    }
    th,td{
        border-radius: 0px;
    }
</style>
<body>
<?php
if($userType == "admin" || $userType == "foreman" || $userType == "user")
{?>
    <?php
     include '../interface_nav.php';   // top_nav 
    ?>     
    <!-- View user list -->
    <div class="outer">
                    <!-- add user -->
                    <?php
                    if(!($userType == "user"))
                    {?>
                    <div class="adduser">
                        <a href="../Create/create_user.php" id="adduser" class="nav_bar">&nbsp;&nbsp;&nbsp;Add User&nbsp;&nbsp;&nbsp;</a>
                    </div>
                    <?php
                    } ?>        
        <center>
    <form action="" method="POST">
        <table>
        <?php
        echo "<table border='0'>";
        echo "<h3 class='userlist'>User List</h3>";
            $id=1;   //initializing id as autoincrement.
            $sql = "SELECT * FROM users"; 
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) 
            {
                $role=$row['role'];
                $u_id=$row['id'];
                ?>
                <tr><td><h4><?php echo $id  ?> </h4></td>
                <th><h2><?php echo $row['fullname'] ?></th><th> <?php echo $role ?>
                <!-- <a href='delete_user.php?id=" <?php echo $u_id;  ?> "'><img src='delete.png' alt='Delete' title='Delete'></a> -->
                <a href='update_user.php?id=<?php echo $u_id; ?>'><img src='update.png' alt='Update' title='Update'></a>
                <a href='user_details_view.php?id=<?php echo $u_id; ?>'><img src='eye.png' alt='View' title='View'></a></h2></th> </tr>
                <?php $id++ ;
            }
            echo "</table>";
            } else 
            {
               echo "<h6>No records found.</h6>";
            }
            mysqli_close($conn);
           
        ?>
        </table>
    </form>
    </center>
               </div>

        
        <div class="footer">
            <!-- Project Management System -->
        </div>
<?php        
}?>
</body>
</html>
