<?php
session_start();
include '../dbconnect/dbconnect.php';
$userType= $_SESSION["user_type"];
echo $userType;
include '../persistLogin.php';
$project_id = $_GET['p_id'];            //getting project id
// echo $project_id;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .btn_Assign{
            float:right:
        }
    </style>
</head>
<body>
    <?php
    if($userType=="admin")
    {?>
        <a style='float:left;' href='../project/project_details.php?id=<?php echo $project_id; ?>'>
            <img style=' height:30px; weight:30px;'src='../view/back_button.png'>
        </a>
    <div class="maindiv">
        <form action="" method="POST">
        <div class="topsubmit">
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
                    $query_users_view="SELECT * from users where role='foreman'";
                    $result_view=mysqli_query($conn,$query_users_view);
                    $num_view=mysqli_num_rows($result_view);
                    if($num_view>0)
                    {
                        while($row=mysqli_fetch_assoc($result_view))
                        {
                            $foreman_id=$row['id'];
                            $fullname=$row['fullname'];
                            $role=$row['role'];
                            $dpt_id=$row['department_id'];
                            ?>
                            <tr>
                                <td><?php echo  $foreman_id ?></td>
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
                                <td><input type="radio" name="checked_id" value="<?php echo $foreman_id; ?>" class="checkbox"></td>                         
                            </tr>
                            <?php
                        }
                    }
                ?>
                
            </table>
            <!-- Done -->
            <input type="submit"  value="Assign" name="submit" class="btn_Assign">
        </div>
    </form>
    </div>
    <!-- submit Assigned Button -->
    <?php
        if(isset($_POST["submit"]))
        {
            // $project_id;
            
            if(!(isset($_POST['checked_id'])))
            {
                echo "Please Select Any Foreman to Assign.";
            }
            if (isset($_POST['checked_id'])) {
                $checked_row_id=$_POST['checked_id'];
                $checkAssignedForemanQuery = "select foreman_id from assigned_member where project_id='$project_id'";
                $checkAssignedForemanResult = mysqli_query($conn, $checkAssignedForemanQuery);
                $num=mysqli_num_rows($checkAssignedForemanResult);
                if($num)
                {
                    while($row = mysqli_fetch_assoc($checkAssignedForemanResult))
                    {
                        $existingForemanId = $row["foreman_id"];
                    }
                }
                
                if(mysqli_num_rows($checkAssignedForemanResult) == 0)
                {
                    $insertForemanIdQuery = "insert into assigned_member (project_id, foreman_id) values('$project_id', '$checked_row_id')";
                    $insertForemanIdResult = mysqli_query($conn, $insertForemanIdQuery);
                    if($insertForemanIdQuery)
                    {
                        // echo $checked_row_id;
                        echo "The Selected User as foreman has been assigned.";
                    }
                    // echo $insertForemanIdQuery;
                }
                else if (mysqli_num_rows($checkAssignedForemanResult) > 0 && $existingForemanId == $checked_row_id)
                {
                    echo "This foreman is already assigned";
                }
                elseif(mysqli_num_rows($checkAssignedForemanResult) > 0 && $existingForemanId != $checked_row_id)
                {
                    $updateForemanIdQuery = "update assigned_member set foreman_id = '$checked_row_id' where project_id = '$project_id'";
                    $updateForemanIdResult = mysqli_query($conn, $updateForemanIdQuery);
                    if($updateForemanIdResult)
                    {
                        // echo $checked_row_id;
                        echo "The New Selected User as foreman has been Assigned and Previous has been UnAssigned.";
                    }
                    // echo $updateForemanIdResult;
                }
            }
        }
    ?>
    <?php
    }?>
</body>
</html>