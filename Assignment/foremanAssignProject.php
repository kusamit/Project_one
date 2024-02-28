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
    <link rel="stylesheet" href="../css/project_details.css">
    <link rel="stylesheet" href="../css/assignment.css">
    <style>
        /* .btn_Assign{
            float:right:
        } */
    </style>
</head>
<body>
    <?php
    // if($userType=="admin")
    // {?>
        <!-- <a style='float:left;' href='../project/project_details.php?id=<?php echo $project_id; ?>'>
            <img style=' height:30px; weight:30px;'src='../view/back_button.png'>
        </a> -->
        <?php
    if($userType=="admin")
{?>
    <?php
        if($userType== "admin")
        { ?>
            <div class="main">
                <table border="1">
                    <!-- fetching project name and details      -->
                    <div class="project_info">
                        <?php
                            $sql="select * from project where id=$project_id" ;
                            $result_view=mysqli_query($conn,$sql);
                            if($result_view)
                                {
                                    echo "";
                                }
                            else
                                {
                                    echo "error database connection";
                                }
                            // Fetched details from the project table
                            $num_view=mysqli_num_rows($result_view);
                            $row_view=mysqli_fetch_assoc($result_view);
                            $fetched_id=$row_view['id'];
                            $fetched_project_name=$row_view['project_name'];
                        ?>
                        <!-- View project Name and Details HTML -->
                        <div id="project_name">
                        <h4 class="p">Project Name <a href="../project/project_details.php?user_type=<?php echo $userType; ?>&id=<?php echo $project_id; ?>" class="back_btn">Back</a></h4>
                            <h4 class="p_n">
                                <?php 
                                echo $fetched_project_name ;
                                ?>
                            </h4>
                        </div> 
                    </div>
                </table>
            </div>
        <?php
    }?>
    <center><div Class="foreman_nav">Foreman List</div></center>
        <div class="showforeman">
            <div class="foremantableview">
            <form action="" method="POST">
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
                </div>
            <div class="foremansubmitview">
                 <!-- submit button -->
            <input type="submit"  value="Assign" name="submit" class="btn_done">
        </form>
        <br><br>
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
                
                if(mysqli_num_rows($checkAssignedForemanResult) == 0 || $existingForemanId==0)
                {
                    $insertForemanIdQuery = "insert into assigned_member (project_id, foreman_id) values('$project_id', '$checked_row_id')";
                    $insertForemanIdResult = mysqli_query($conn, $insertForemanIdQuery);
                    if($insertForemanIdQuery)
                    {
                        echo "ForemanId   ";
                        echo $checked_row_id;
                        echo "   has been assigned.";
                    }
                    // echo $insertForemanIdQuery;
                }
                else if (mysqli_num_rows($checkAssignedForemanResult) > 0 && $existingForemanId == $checked_row_id)
                {
                    echo "ForemanId   ";
                    echo $checked_row_id;
                    echo "   is already assigned";
                }
                elseif(mysqli_num_rows($checkAssignedForemanResult) > 0 && $existingForemanId != $checked_row_id)
                {
                    $updateForemanIdQuery = "update assigned_member set foreman_id = '$checked_row_id' where project_id='$project_id' AND user_id='0'";
                    $updateForemanIdResult = mysqli_query($conn, $updateForemanIdQuery);
                    if($updateForemanIdResult)
                    {
                        echo "ForemanId   ";
                        echo $existingForemanId;
                        echo "   has UnAssigned and   ";
                        echo $checked_row_id;
                        echo "   has been Assigned.";?><br><br><?php
                    }
                    // echo $updateForemanIdResult;
                }
            }
        }
    ?>
        </div>    
    </div>
    <?php
    }
    else
    {
        echo "Access Forbidden";
    }?>
</body>
</html>