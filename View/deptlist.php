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
    <title>Department</title>
    <link rel="stylesheet" href="../css/interface.css">
    <link rel="stylesheet" href="../css/head_nav.css">
</head>
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
                    if(!($userType == "user" || $userType == "foreman"))
                    {?>
                    <div class="adduser">
                        <a href="../Create/create_department.php" id="adduser" class="nav_bar">Add Department</a>
                    </div>
                    <?php
                    } ?>
                
    <center>
        <form action="" method="POST">
        <table>
            <?php
            echo "<table border='0'>";
            echo "<h3>Department List </h3>";
                $id=1;   //initializing id as autoincrement.
                $sql = "SELECT * FROM department"; 
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) 
                    {
                        echo "<tr></tr>
                        <tr><th><h4>" . $id . "</h4></th>
                        <th><h2>". $row['department_name'] . 
                        // "<a href='user_details_view.php?id=" . $row['dpt_id'] . "'><img src='delete.png' alt='Delete' title='Delete'></a>",
                        // "<a href='user_details_view.php?id=" . $row['dpt_id'] . "'><img src='update.png' alt='Update' title='Update'></a>",
                        "<a href='update_department.php?id=" . $row['dpt_id'] . "'><img src='update.png' alt='Update' title='Update'></a>
                        </a></h2></th> </tr>";
                        $id++;
                    }
                echo "</table>";
                } 
                else 
                {
                    echo "<h6>No records found.</h6>";
                }
                mysqli_close($conn);
            ?>
            <tr>

            </tr>
        </table>
        </form>
    </center>
               <!-- </div> -->
        <div class="footer">
            <!-- Project Management System -->
        </div>
<?php        
}?>
</body>
</html>
