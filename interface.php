<?php
session_start();
include './dbconnect/dbconnect.php';
$userType= $_SESSION["user_type"];
$user_admin_id=$_SESSION['Login_session'];
include './persistLogin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management System</title>
    <link rel="stylesheet" href="./css/interface.css">
</head>
<body>
<?php
if($userType == "admin")
{?>
<script>
    function logout() {
        // If the user confirms, redirect to the logout page
        return  confirm("Are you sure you want to logout?");
    }
    </script>
    <div class="top_nav">
            <a onclick=" return logout()" href="./credentials/logout.php?id=<?php echo $user_admin_id?>" class="top_nav_bar" id="logout">Logout</a>
            <a href="./Create/create_project.php" class="top_nav_bar">Create Project</a>
            <a href="./view/userlist.php" class="top_nav_bar">Users</a>
            <a href="./view/deptlist.php" class="top_nav_bar">Department</a>
            <a href="./interface.php" class="top_nav_bar">Home</a>
            <h2 class="dashboard">Admin Dashboard</h2>
        </div>
        <div class="head">
            <h1>Project Management System</h1>
        </div>
        <?php
            $admin_id = mysqli_real_escape_string($conn, $user_admin_id);

            $admin_name_query = "SELECT * FROM admin WHERE id = '$admin_id'";
            $result_admin_name = mysqli_query($conn, $admin_name_query);
            $num_admin = mysqli_num_rows($result_admin_name);
            // Check if at least one row is returned
            if ($num_admin > 0) 
            {
                $admin_row = mysqli_fetch_array($result_admin_name);
                $admin_name = $admin_row['username'];
            } 
            else 
            {
                $db_name = "Unknown Admin";
            }
        ?>

        <div class="nav">
            <h2 class="admin_name"><?php echo $admin_name;?><br><?php echo "Username"; ?></h2>
        </div>

        <!-- View project details -->
        <div class="outer">
            <center>
            <form action="" method="POST">
                <table border="0">
                <h3>Project List</h3>
                <?php
                $sn=1;   //initializing id as autoincrement.
                    $sql = "SELECT * FROM project"; 
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        // echo "";
                        echo "<table border='0'>
                    ";
                    while ($row = mysqli_fetch_assoc($result)) 
                    {
                        $id=$row["id"];
                        include "./Assignment/supervised.php";
                        ?>
                        <tr>
                            <th><h4><?php echo $sn ?></h4></th>
                            <th><h2><?php echo $row['project_name'] ?>
                                <a href='./project/project_details.php?id=<?php echo $row['id'] ?>'>
                                <?php 
                                // Output supervised name if assigned
                                if (!empty($supervised_name)) {
                                    echo "Supervised: " . $supervised_name;
                                }
                                ?>
                                <img src='./view/eye.png' alt='View' title='View'>
                                </a>
                            </h2></th>
                        </tr>
        <?php 
        $sn++; // Incrementing $id
    }
                    // }
                    echo "</table>";
                    } 
                    else
                    {
                        echo "<h6>No records found.</h6>"; }
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
}
else if ($userType == "foreman") 
{ ?>
    <div class="top_nav">
            <a href="./credentials/logout.php?id=<?php echo $user_admin_id?>" class="top_nav_bar" id="logout">Logout</a>
            <!-- <a href="./Create/create_project.php" class="top_nav_bar">Create Project</a> -->
            <a href="./view/userlist.php" class="top_nav_bar">Users</a>
            <a href="./view/deptlist.php" class="top_nav_bar">Department</a>
            <a href="./interface.php" class="top_nav_bar">Home</a>
            <h2 class="dashboard">Foreman Dashboard</h2>
        </div>
        <div class="head">
            <h1>Project Management System</h1>
        </div>
        <?php
            $foreman_id = mysqli_real_escape_string($conn, $user_admin_id);
            $foreman_name_query = "SELECT * FROM users WHERE id = '$foreman_id'";
            $result_foreman_name = mysqli_query($conn, $foreman_name_query);
            $num_foreman = mysqli_num_rows($result_foreman_name);
            if ($num_foreman > 0) 
            {
                $foreman_row = mysqli_fetch_array($result_foreman_name);
                $foreman_name = $foreman_row['username'];
            } 
            else 
            {
                $db_name = "Unknown Admin";
            }
        ?>

        <div class="nav">
            <h2 class="foreman_name"><?php echo $foreman_name;?><br><?php echo "Username"; ?></h2>
        </div>

        <!-- View project details -->
        <div class="outer">
            <center>
            <form action="" method="POST">
                <table border="0">
                <h3>Projects</h3>
                <?php
                $id=1;   //initializing id as autoincrement.
                    $query_assigned_member = "SELECT * FROM assigned_member where foreman_id='$foreman_id'"; 
                    $result_foreman = mysqli_query($conn, $query_assigned_member);
                    if (mysqli_num_rows($result_foreman) > 0) {
                    while ($assigned_row = mysqli_fetch_assoc($result_foreman)) 
                    {
                        $fetched_project_id=$assigned_row['project_id'];
                        $fetched_foreman_id=$assigned_row['foreman_id'];
                        // fetched from project
                        $project_query="SELECT * from project where id='$fetched_project_id'";
                        $project_result = mysqli_query($conn, $project_query);
                        if (mysqli_num_rows($project_result) > 0)
                         {
                            while ($project_row = mysqli_fetch_assoc($project_result)) 
                            {
                                $project_id=$project_row['id'];
                                $project_name=$project_row['project_name'];
                            }
                        }
                        echo "<tr><th><h4>" . $id . "</h4></th>
                        <th><h2>". $project_name . "<a href='./project/project_details.php?id=" . $project_id . "'>
                        <img src='./view/eye.png' alt='View' title='View'>
                        </a></h2></th> </tr>";
                        $id++;
                    }
                    echo "</table>";
                    } else {
                    echo "No records found.";}
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
} 
else if ($userType == "user") 
{?>
    <div class="top_nav">
            <a href="./credentials/logout.php?id=<?php echo $user_admin_id?>" class="top_nav_bar" id="logout">Logout</a>
            <a href="./interface.php" class="top_nav_bar">Home</a>
            <h2 class="dashboard">User Dashboard</h2>
        </div>
        <div class="head">
            <h1>Project Management System</h1>
        </div>
        <?php
            $user_id = mysqli_real_escape_string($conn, $user_admin_id);
            $user_name_query = "SELECT * FROM users WHERE id = '$user_id'";
            $result_user_name = mysqli_query($conn, $user_name_query);
            $num_user = mysqli_num_rows($result_user_name);
            if ($num_user > 0) 
            {
                $user_row = mysqli_fetch_array($result_user_name);
                $user_name = $user_row['username'];
            } 
            else 
            {
                $db_name = "Unknown Admin";
            }
        ?>
            <div class="nav">
             <h2 class="foreman_name"><?php echo $user_name;?><br><?php echo "Username"; ?></h2>
            </div>
<!-- View project details -->
        <div class="outer">
            <center>
            <form action="" method="POST">
                <table border="0">
                <h3>Project List</h3>
                <?php
                $sn=1;   //initializing id as autoincrement.
                    $sql = "SELECT * FROM project"; 
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        // echo "";
                        echo "<table border='0'>
                    ";
                    while ($row = mysqli_fetch_assoc($result)) 
                    {
                        $id=$row["id"];
                        include "./Assignment/supervised.php";
                        ?>
                        <tr>
                            <th><h4><?php echo $sn ?></h4></th>
                            <th><h2><?php echo $row['project_name'] ?>
                                <a href='./project/project_details.php?id=<?php echo $row['id'] ?>'>
                                <?php 
                                // Output supervised name if assigned
                                if (!empty($supervised_name)) {
                                    echo "Supervised: " . $supervised_name;
                                }
                                ?>
                                <img src='./view/eye.png' alt='View' title='View'>
                                </a>
                            </h2></th>
                        </tr>
        <?php 
        $sn++; // Incrementing $id
    }
        echo "</table>";
    } 
    else 
        {
        echo "No records found.";}
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
}
?>
</body>
</html>
