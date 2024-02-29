<?php
include '../dbconnect/dbconnect.php';
session_start();
$project_id = $_GET['p_id'];     //getting project id
   $userType = $_SESSION["user_type"];//getting usertype
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
</head>
<style>
h1
{
    color:darkblue;
    margin-left: 1.8rem;
}
</style>
<body>
<?php
    if($userType=="admin" || $userType=="foreman" || $userType=="user")
{?>
    <?php
        if($userType== "admin" || $userType== "foreman" || $userType=="user")
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
                        <h4 class="p">Project Name <a href="./assigned_user.php?user_type=<?php echo $userType; ?>&p_id=<?php echo $project_id; ?>" class="back_btn">Back</a></h4>
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
         <hr>
        <div class="layout">
            <h1>State</h1>
            <a href="./userAssignProject.php?p_id=<?php echo $project_id; ?>" id="assign_a_nav">Assign</a>
            <a href="./unassign.php?p_id=<?php echo $project_id; ?>" id="assign_a_nav">UnAssign</a>
        </div>
        <center><div Class="user_nav">Assigned User</div></center>
        <div class='showuser'>
            <div class="usertableview">
                <form action="" method="POST">
                    <table border="1">
                    <!-- php -->
                        <?php
                            $query_assigned_view="SELECT * from assigned_member where project_id='$project_id'";
                            $result_assigned=mysqli_query($conn,$query_assigned_view);
                            $num_assigned=mysqli_num_rows($result_assigned);
                            if($num_assigned>0)
                            {?>
                                <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Department</th>
                                <th>UnAssign</th>
                                </tr>
                                <?php
                                while($row=mysqli_fetch_assoc($result_assigned))
                                {
                                    $assigned_user_id=$row['user_id'];
                                    $query_users_view="SELECT * from users where id='$assigned_user_id'";
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
                                        }
                                    }
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
                                        <!-- <td><input type="submit" value="Assign" name="submit" class="btn_done"></td>                       -->
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                echo "No Members Found.";
                            }
                        ?>
                    </table>
            </div>
            <div class="usersubmitview">
                <input type="submit" value="UnAssign" name="submit" class="btn_done">
            </form>
            <br><br>
            <!-- submit Assigned Button -->
        <?php
            if (isset($_POST["submit"])) 
            {
                if (!isset($_POST['checked_id'])) 
                {
                    echo "Please Select Any User to UnAssign.";
                    exit();
                } 
                else if (isset($_POST['checked_id']) && is_array($_POST['checked_id'])) 
                {
                    foreach ($_POST['checked_id'] as $checked_row_id) 
                    {
                        $checkAssignedUserQuery = "DELETE FROM assigned_member WHERE project_id='$project_id' AND user_id='$checked_row_id'";
                        $AssignQueryResult = mysqli_query($conn, $checkAssignedUserQuery);
                    }
                    echo '<script>
                    window.location.href = "unassign.php?p_id=' . $project_id . '";
                    </script>';
                }
                 
            }
            else
            {
                exit();
            }
            ?>
            </div>
        </div>
        </script>
    <?php
    }
    else
    { echo "Access Forbidden";
    }?>
</body>
</html>

