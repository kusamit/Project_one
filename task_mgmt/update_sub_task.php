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
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $main_task_id = $_GET['main_task_id'];
            $project_id = $_GET['project_id'];
            $query_select = "SELECT * FROM sub_task_mgmt WHERE id='$id'";
            $result_select = mysqli_query($conn, $query_select);

            if ($result_select) {
                $num = mysqli_num_rows($result_select);

                if ($num > 0) {
                    $rows = mysqli_fetch_assoc($result_select);
                    ?>
                    <table border='2px solid #adad85'>
                        <?php  $msg= $rows['message'];?>
                        <?php  $deadline= $rows['end_date_time'];?>
                        <tr><td>Task Details</td></tr>
                        <tr><td><input type="text" name="task" value="<?php echo $msg; ?>"></td></tr>
                        <tr><th>Date and Time</th></tr>
                        <tr><td><input type="datetime-local" name="dt" value="<?php echo $deadline; ?>"></td></tr>
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
        // include 'dbconnect.php';
        if (isset($_POST['update'])) {
            $message = $_POST['task'];
            $date_time = $_POST['dt'];
            $id = $_GET['id'];
            $main_task_id = $_GET['main_task_id'];
            $update_query = "UPDATE sub_task_mgmt SET message='$message', end_date_time='$date_time' WHERE id='$id'";
            $result_update = mysqli_query($conn, $update_query);
            if ($result_update) {
                echo "Updated";
                    header('Location: sub_task_list.php?main_task_id='. $main_task_id.'&project_id='.$project_id);
            } else {
                echo "Error";
            }
        } 
        ?>
    <?php
    }?>

    <?php
    if($userType=="user")
    {?>
        <form action="" method="POST">
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $main_task_id = $_GET['main_task_id'];
            $project_id = $_GET['project_id'];
            $query_select = "SELECT * FROM sub_task_mgmt WHERE id='$id'";
            $result_select = mysqli_query($conn, $query_select);

            if ($result_select) {
                $num = mysqli_num_rows($result_select);

                if ($num > 0) {
                    $rows = mysqli_fetch_assoc($result_select);
                    ?>
                    <table border='2px solid #adad85'>
                        <?php  $msg= $rows['message'];?>
                        <?php  $deadline= $rows['end_date_time'];?>
                        <tr><td>Task Details</td></tr>
                        <tr><td><input type="text" name="task" value="<?php echo $msg; ?>"></td></tr>
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
        if (isset($_POST['update'])) {
            $message = $_POST['task'];
            $id = $_GET['id'];
            $main_task_id = $_GET['main_task_id'];
            $update_query = "UPDATE sub_task_mgmt SET message='$message' WHERE id='$id'";
            $result_update = mysqli_query($conn, $update_query);
            if ($result_update) {
                echo "Updated";
                    header('Location: sub_task_list.php?main_task_id='. $main_task_id.'&project_id='.$project_id);
            } else {
                echo "Error";
            }
        } 
        ?>
    <?php
    }?>
        
</body>
</html>
