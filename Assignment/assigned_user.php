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
if($userType== "admin" || $userType== "foreman" || $userType=="user")
        { ?>
    <?php
        include "./header/header.php";
    ?>
        <?php
        if(!($userType=='user')){?>
        <div class="layout">
               <!-- <h1>State</h1> -->
                <a href="./userAssignProject.php?p_id=<?php echo $project_id; ?>" id="assign_user">Assign</a>
                <a href="./unassign.php?p_id=<?php echo $project_id; ?>" id="assign_user">UnAssign</a>
                 </div> 
            <?php
            }?>
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
                                </tr>
                                <?php
                                while($row=mysqli_fetch_assoc($result_assigned))
                                {
                                    $assigned_user_id=$row['user_id'];
                                    if($assigned_user_id=='0')
                                    {
                                        // echo "No Assigned Member Found.";
                                    }
                                    else if(!$assigned_user_id=='0')
                                    {
                                        $query_users_view="SELECT * from users where id='$assigned_user_id'";
                                        $result_view=mysqli_query($conn,$query_users_view);
                                        $num_view=mysqli_num_rows($result_view);
                                        if($num_view>0)
                                        {
                                            while($row=mysqli_fetch_assoc($result_view))
                                            {
                                                $user_id=$row['id'];
                                                // echo $user_id;
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
                                        </tr>
                                        <?php
                                    }
                                }
                                
                            }
                            else
                            {
                                echo "No Assigned Member Found.";
                            }
                        ?>
                    </table>
            </div>
            </form>
        </div>
    <?php
    }
    else
    { echo "Access Forbidden";
    }?>
</body>
</html>

