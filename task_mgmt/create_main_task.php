<?php
include '../dbconnect/dbconnect.php'; 
session_start();
$project_id = $_GET['p_id'];
// echo $project_id;
$userType= $_SESSION["user_type"];
// echo $userType;
include '../persistLogin.php';
?>
<html>
    <head>
        <title>Create Main Task | Topics</title>
        <link rel="stylesheet" href="./subtaskcss/taskstyle.css">
        <link rel="stylesheet" href="../css/project_details.css">
        <link rel="stylesheet" href="../css/assignment.css">
    </head>
    
    <body>
    <?php
        include "./header.php";
    ?>
   <?php
   if($userType=="admin" || $userType=="foreman")
   {?>
      <form action="" method="POST">
       <p>Create Main Task | Topics</p> 
        <label for="topic">Name of Topic</label><br>
        <label for="w_topic"><input type="text" name="task" placeholder="Name of Tasks" required id="task_name"></label><br>
        <label for="Assign">Assign to User</label>
        <label for="Assign_user"><?php include '../Assignment/userAssignMainTask.php';?></label><br>
        <label for="deadline">Deadline</label> <br>
        <label for="deadlinetask"><input type="datetime-local" name="dt" id="" required></label>
        <center>
        <input type="submit" value="Create" name="create" id="submit"><br><br>
        </form>
    <?php
        include 'dbconnect.php';
        if(isset($_POST['create']))
        {
            
            if(!(isset($_POST['user_name'])))
            {
                echo "Please select User";
            }
            else
            {   
                $create=$_POST['task'];
                $assigned_id=$_POST['user_name'];
            // }
            $datetime=$_POST['dt'];
            $query="INSERT INTO main_task (name,project_id,user_id,deadline) values ('$create','$project_id','$assigned_id','$datetime') ";
            $check_duplicate_query = "SELECT * FROM main_task WHERE name='$create'";
            $check_duplicate_result = mysqli_query($conn, $check_duplicate_query);
            if($check_duplicate_result->num_rows > 0)
            {
                echo "This username already exists!";
            }
            else
            {
                $result=mysqli_query($conn,$query);
                echo $create;
                echo "  as Main Task | Topics is Created!";
            }
        }
        }
    ?> </center> 
    <?php
    }?> 
    </body>
</html>