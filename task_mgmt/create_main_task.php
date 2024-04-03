<?php
include '../dbconnect/dbconnect.php'; 
session_start();
$project_id = $_GET['p_id'];
$user_admin_id=$_SESSION['Login_session'];
// echo $project_id;
$userType= $_SESSION["user_type"];
// echo $userType;
include '../persistLogin.php';
?>
<html>
    <title>Main Task | Topic</title>
    <head>
        <title>Create Main Task | Topics</title>
        <link rel="stylesheet" href="./subtaskcss/taskstyle.css">
        <link rel="stylesheet" href="../css/headpname.css">
        <!-- <link rel="stylesheet" href="../css/project_details.css"> -->
        <!-- <link rel="stylesheet" href="../css/assignment.css"> -->
    </head>
    <style>
        body
        {
            background-color: white;
            margin:0px;
            padding:0px;
        }
    </style>
    <body>
    <?php
    include '../interface_nav.php';
        include "../assignment/header/header.php";
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
        <label for="deadlinetask"><input type="datetime-local" name="dt" id="datePicker" required></label>
        <script src="./js/validatebackdate.js"></script>
        <center>
        <input type="submit" value="Create" name="create" id="submit"><br><br>
        </form>
        <?php
            if(isset($_POST['create'])) {
                if(!(isset($_POST['user_name']))) 
                {
                    echo "<script>alert('Please select a User.');</script>"; 
                } 
                else 
                {   
                    $create = $_POST['task'];
                    $assigned_id = $_POST['user_name'];
                    $datetime = $_POST['dt'];
                    $check_duplicate_query = "SELECT * FROM main_task WHERE name='$create' AND project_id='$project_id'";
                    $check_duplicate_result = mysqli_query($conn, $check_duplicate_query);

                    if($check_duplicate_result->num_rows > 0) {
                        echo "<script>alert('This Main Task | Topic already exists for this project!');</script>"; 
                    } else {
                        $query = "INSERT INTO main_task (name, project_id, user_id, deadline) VALUES ('$create', '$project_id', '$assigned_id', '$datetime')";
                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            echo "<script>alert('Main Task | Topic has been created successfully');</script>";
                            header("Refresh:0;url='../project/project_details.php?user_type=" . $userType . "&id=" . $project_id . "'");
                        } else {
                            echo "<script>alert('Error creating task');</script>";
                        }
                    }
                }
            }
        ?>
 </center> 
    <?php
    }?> 
    </body>
</html>