<?php
// include 'session.php';
include './dbconnect/dbconnect.php';
session_start();
$admin_id=$_SESSION['Login_session'];
// echo $admin_id;
?>
<html>
    <head>
        <title></title>
        <!-- <link rel="stylesheet" href="./css/creation.css"> -->
    </head>
    <style>
        body
        {
            /* align-items:center; */
            /* background-color:lightgrey; */
            margin:0px;
            padding:0px;
            /* margin-left:3rem; */
        }
        tr,th
        {
            text-align:left;
            background-color:grey;
            color:White;
            border-radius:5px;
            height:5px;
            margin-bottom:20px;
        }
        table
        {
            width:90%;
            /* margin-left:20%; */
            margin-bottom:2rem;
            margin-top:2px;
            align-items:center;
            text-align:center;
            height:5px;
            box-shadow: inset;
        }
        form
        {
            /* width:100%; */
        }

        h2{
            /* margin-left:30px; */
            margin-top:15px;
            font-size:20px;
            margin-bottom:10px;
        }
        img:hover
        {
            background-color:whitesmoke;
            font-size:max-content;
            padding:2px;
            border-radius:5px;
            width:Max-content;
        }
        h3
        {;
            font-size:20px;
            padding:5px;
            background-color:#003399;
            color:white;
            margin:0px;
        }
        h4
        {
            text-align:center;
            margin-top:15px;
            font-size:20px;
            margin-bottom:10px;
        }
        .outer
        {
            margin:0px;
            /* background-color:lightgrey; */
            background-color:white;
            /* width:100%; */
            border-radius:5px;
        }
        a{
            text-decoration:none;
            color:white;
            float:right;
            style-type:inline;
            
        }
        
        img
        {
            height:20px;
            width:20px;
            margin-left:20px;
            
        }
        .top_nav
        {
            margin:0px;
            margin-bottom:35px;
            padding:10px;
            color:black;
            background-color:white;
            border-radius:5px;
            text-decoration:none;
            font-family: "Times New Roman", Times, serif;
            font-size:90%;
            }
        .top_nav_bar
        {
            margin-left:3rem;
            padding:10px;
            color:black;
            background-color:white;
            border-radius:5px;
            text-decoration:none;
            font-family: "Times New Roman", Times, serif;
            font-size:20px;
            
        }
        .top_nav_bar:hover
            {
                background-color: #ffd966;
                width:fit-content;
                border-radius:5px;
            }
        .nav
            {
               margin-bottom:3rem; 
            }
        .nav_bar
            {
                margin-left:3rem;
                padding:10px;
                color:black;
                background-color:white;
                border-radius:5px;
                text-decoration:none;
                font-family: "Times New Roman", Times, serif;
                font-size:20px;
                float:left;
            }
        .nav_bar:hover
            {
                background-color: #ffd966;
                width:fit-content;
                border-radius:5px;
            }
        .head
        {
            background-color:#33bbff;
            padding:1px;
            color:White;
            padding-left:30px;
        }
        .footer
        {
            background-color:#adad85;
            color:white;
            margin-top:50px;
            padding:20px;
        }
        .admin_name
        {
            float:right;
            margin-right:5rem;
            margin-top:0px;
            /* padding:10px; */
            text-align:center;
            justify-content:center;
            color: #000080;
        }
        .dashboard
        {
            float:left;
            margin:10px;
            margin-left:30px;
            color: #000080;
        }
        #logout
        {
            margin:0px;
            margin-top:65px;
            padding:10px;

        }
    </style>
    <body>
        <div class="top_nav">
            <a href="#1" class="top_nav_bar" id="logout">Logout</a>
            <a href="./Create/create_project.php" class="top_nav_bar">Create Project</a>
            <a href="./Create/create_user.php" class="top_nav_bar">Add Users</a>
            <a href="./Create/ceate_department.php" class="top_nav_bar">Add Department</a>
            <h2 class="dashboard">Admin Dashboard</h2>
        </div>
        <div class="head">
            <h1>Project Management System</h1>
        </div>
        <?php
    $admin_id = mysqli_real_escape_string($conn, $admin_id);

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
    <a href="./view/userlist.php" class="nav_bar">Users</a>
    <a href="./view/deptlist.php" class="nav_bar">Department</a>
    <h2 class="admin_name"><?php echo $admin_name;?><br><?php echo "Username"; ?></h2>
</div>

        <!-- View project details -->
        <div class="outer">
            <center>
            <form action="" method="POST">
                <table border="0">
                <?php
                $id=1;   //initializing id as autoincrement.
                    $sql = "SELECT * FROM project"; 
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo "<h3>Projects</h3>";
                        echo "<table border='0'>
                    ";
                    while ($row = mysqli_fetch_assoc($result)) 
                    {

                        echo "<tr><th><h4>" . $id . "</h4></th>
                        <th><h2>". $row['project_name'] . "<a href='./project/project_details.php?id=" . $row['id'] . "'>
                        <img src='./view/eye.png' alt='View' title='View'></a>","<a href='project_details.php?id=" . $row['id'] . "'>
                        <img src='./view/update.png' alt='Update' title='Update'></a></h2></th> </tr>";
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
    </body>
</html>