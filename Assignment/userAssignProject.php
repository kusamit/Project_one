<?php
include '../dbconnect/dbconnect.php';
$project_id = $_GET['p_id'];            //getting project id

echo $project_id;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <a style='float:left;' href='../project/project_details.php?id=<?php echo $project_id; ?>'>
            <img style=' height:30px; weight:30px;'src='../view/back_button.png'>
        </a>
    <div class="maindiv">
        <form action="" method="POST">
        <div class="topsubmit">
            <!-- <button name="submit" class="btn_done"> -->
                <!-- Done -->
                <input type="submit" placeholder="Done" name="submit" class="btn_done" style="width='max-content;'">
            <!-- </button> -->
        </div>
        <div class="usersview">
            <table border="1">
                <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Role</th>
                <th>Department</th>
                <th>Assign</th>
                </tr>
            <!-- php -->
                <?php
                    $query_users_view="SELECT * from users where role='user'";
                    $result_view=mysqli_query($conn,$query_users_view);
                    $num_view=mysqli_num_rows($result_view);
                    if($num_view>0)
                    {
                        while($row=mysqli_fetch_assoc($result_view))
                        {
                            $user_id=$row['id'];
                            $fullname=$row['fullname'];
                            $role=$row['role'];
                            $dpt_id=$row['department_id'];
                            ?>
                            <tr>
                                <td><?php echo  $user_id ?></td>
                                <td><?php echo $fullname  ?></td>
                                <td><?php echo $role ?></td>
                        <!-- fetch department name from the department table using the foreign key from users table. -->
                            <?php
                                $query_department_view="SELECT * from department where dpt_id='$dpt_id'";
                                $dpt_result_view=mysqli_query($conn,$query_department_view);
                                if($dpt_result_view)
                                {
                                    // echo "connection sucess";
                                }
                                else
                                {
                                    echo "unsucess to connect";
                                }
                                $num_view=mysqli_num_rows($dpt_result_view);
                                    $row=mysqli_fetch_assoc($dpt_result_view);
                                        $dpt_name=$row['department_name'];
                            ?>
                                <td><?php echo $dpt_name ?></td>    
                                <td><input type="checkbox" name="checked_id[]" value="<?php echo $user_id; ?>" class="checkbox"></td>                         
                            </tr>
                            <?php
                        }
                    }
                ?>
                
            </table>
        </div>
        <!-- submit Assigned Button -->
        <?php
        if(isset($_POST["submit"]))
            {
                $p_id=$project_id;
                if (isset($_POST['checked_id']) && is_array($_POST['checked_id'])) {
                    foreach ($_POST['checked_id'] as $checked_row_id) {
                    $sql_assign="INSERT INTO assigned_member (project_id,user_id) 
                    values ('$p_id','$checked_row_id')";
                    // var_dump($checked_row_id);
                    // die();
                    $result_query_assigned=mysqli_query($conn,$sql_assign);
                        if($result_query_assigned)
                        {

                        }
                        else
                        {
                            echo "error to Assign data";
                        }
                    }
                }
                echo "Selected Users has been assigned.";
                }

            // }
        ?>
    </form>
    </div>
</body>
</html>