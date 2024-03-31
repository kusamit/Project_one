<?php
include '../dbconnect/dbconnect.php'; 
session_start();
$userType= $_SESSION["user_type"];
// echo $userType;
$project_id=$_GET['project_id'];
include '../persistLogin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Task | Topic</title>
        <link rel="stylesheet" href="../css/project_details.css">
</head>
<style>
    .updatemaintask
    {
        border: 1px whitesmoke solid;
        border-radius: 4px;
        margin-top: 40px;
        margin-right: 20px;
        padding: 80px;
        padding-top: 0px;
        width:20%;
        background-color: whitesmoke;
    }
    h3{
        margin-top: 50px;
        margin-bottom: 50px;
        color:#191966;
    }
</style>
<body>
    <?php
   if($userType=="admin" || $userType=="foreman")
   {    include "./header.php";
    ?>
        <form action="" method="POST">
        <?php
        if (isset($_GET['id'])) {
            $main_task_id = $_GET['id'];
            $user_id = $_GET['user_id'];
            $project_id = $_GET['project_id'];
            $query_update = "SELECT * FROM main_task WHERE Id='$main_task_id'";
            $result_update = mysqli_query($conn,$query_update);

            if ($result_update) {
                $num = mysqli_num_rows($result_update);

                if ($num > 0) {
                    $rows = mysqli_fetch_assoc($result_update);
                    ?><center>
                    <div class="updatemaintask">
                    <h3>Update Main Task | Topic
                    <hr>
                    </h3>
                    <table border='0px solid #adad85'>
                            <tr><th>Main Task | Topic</th></tr>
                            <?php  $name= $rows['name'];?>
                            <tr><td><input type="text" name="task" value="<?php echo $name; ?>"></td></tr>
                            <?php
                            if(!($userType=="user"))
                            {?>
                            <tr><th>Date and Time</th></tr>
                               <?php  $deadline= $rows['deadline'];?>
                                <tr><td><input type="datetime-local" name="dt" id="" value='<?php echo $deadline; ?>' ></td></tr> 
                            <?php
                            }?>
                                <?php 
                                ?>
                    </table>
                    <input type="submit" value="update" name="update" id="update">
                    </div>
                    </center>
                    <?php
                }
            }
            else {
                echo "Error insert";
            }
        }
        ?>
        </form>

        <?php
        include 'dbconnect.php';
        if (isset($_POST['update'])) {
            $main_task_id = $_GET['id'];
            $main_task_name = $_POST['task'];
            $date_time = $_POST['dt'];
            $user_id = $_GET['user_id'];
            $toupdate_query = "UPDATE main_task SET name='$main_task_name', deadline='$date_time' WHERE Id='$main_task_id'";
            $toresult_update = mysqli_query($conn, $toupdate_query);
            if ($toresult_update) {
                // echo "Updated";
                header('Location:../project/project_details.php?id='.$project_id);
            } else {
                echo "Error";
            }
        } 
        ?>
    <?php
    }?>
</body>
</html>
