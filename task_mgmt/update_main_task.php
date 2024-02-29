<?php
include '../dbconnect/dbconnect.php'; 
session_start();
$userType= $_SESSION["user_type"];
echo $userType;
include '../persistLogin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
   if($userType=="admin" || $userType=="foreman")
   {?>
        <form action="" method="POST">
        <?php
        // include 'dbconnect.php';
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
                    ?>
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
                            <!-- <tr><th>Assign User</th></tr> -->
                            <!-- <tr><th> -->
                                <?php 
                                // include '../Assignment/userAssignMainTask.php';  
                                ?>
                            <!-- </th></tr> -->
                    </table>
                    <input type="submit" value="update" name="update" id="update">
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
            // $assigned_id=$_POST['user_name'];
            // user_id='$assigned_id'
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
