<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="update.php" method="POST">
    <?php
    include 'dbconnect.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $cat_id = $_GET['cat_id'];
        $query_select = "SELECT * FROM list_msg WHERE id='$id'";
        $result_select = mysqli_query($conn, $query_select);

        if ($result_select) {
            $num = mysqli_num_rows($result_select);

            if ($num > 0) {
                $rows = mysqli_fetch_assoc($result_select);
                ?>
                <table border='2px solid #adad85'>
                    <tr>
                        <td>Task Details</td>
                        <th>Date and Time</th>
                    </tr>
                    <tr>
                        <?php  $msg= $rows['message'];?>
                        <?php  $deadline= $rows['end_date_time'];?>
                        <td><input type="text" name="task" value="<?php echo $msg; ?>"></td>
                        <td><input type="datetime-local" name="dt" value="<?php echo $deadline; ?>"></td>
                    </tr>
                </table>
                <input type="submit" value="Update" name="submit" id="update">
                <?php
            }
        } else {
            echo "Error";
        }
    if (isset($_POST['submit']))
    {
        $message =$_POST['task'];
        $date_time =$_POST['dt'];
        $update_query = "UPDATE list_msg SET message='$message', end_date_time='$date_time' WHERE id='$id'";
        $result_update = mysqli_query($conn, $update_query);
        if($result_update)
        {
            echo "updated";
            // header('Location:sub_task_list.php?id='.$cat_id);
        }
        else{
            echo "error";
        }
    }
}
    ?>
    </form>
</body>
</html>