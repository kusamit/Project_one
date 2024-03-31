<?php
include '../dbconnect/dbconnect.php'; 
session_start();
$userType= $_SESSION["user_type"];
// echo $userType;
include '../persistLogin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
.top_nav_update
{
    background-color: white;
    height: 3rem;
    width: 100%;
    border-radius: 3px;
    justify-content: center;
    background-color: darkblue;
    padding: 2rem; 
    color:white;
}
.dashboard_update
{
    padding: 0px;
    justify-content: center;
    color: white;

}
.top_nav_bar_update
{
    background-color: white;
    color: black;
    float: right;
    margin-right: 3rem;
    padding: 10px;
    border-radius: 4px;
    text-decoration: none;
    
}
.top_nav_bar_update:hover
{
 background-color: #ffd966;   
}
.wholebody
{
   background-color: rgb(219 219 157 / 86%);
   margin:8rem;
   /* padding: ; */
   width:40%;
   height: 200%;
   padding: 3rem;
}

    </style>
    <!-- <link rel="stylesheet" href="../css/subtasklist.css"> -->

</head>
<body>

 
<?php
    if($userType=="admin" || $userType=="foreman")
    {?>
    <?php
        // include 'dbconnect.php';
        $main_task_id = $_GET['main_task_id'];
        $project_id = $_GET['project_id'];
?>
            <div class="top_nav_update">
                <!-- <a href="./sub_task_list.php?user_type=<?php echo $userType; ?>&main_task_id=<?php echo $main_task_id ; ?>&project_id=<?php echo $project_id ;?> " class="top_nav_bar_update">Back</a></h4> -->
                <a href="../interface.php" class="top_nav_bar_update">Home</a>
                <h2 class="dashboard_update">Task Management</h2>
               
            </div>
            <center>
            <div class="wholebody">
                <h2>Update</h2>
           
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
                    <table border='0px'>
                        <?php  $msg= $rows['message'];?>
                        <?php  $deadline= $rows['end_date_time'];?>
                        <tr><td>Task Name</td></tr>
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
                    <table border='0'>
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
        } ?>
         </div>
        </center>
        <?php
    }?>
        
</body>
</html>
