<?php
include '../dbconnect/dbconnect.php';
session_start();
$project_id = $_GET['p_id'];     //getting project id
$user_admin_id=$_SESSION['Login_session'];
   $userType = $_SESSION["user_type"];//getting usertype
// echo $project_id;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="../css/project_details.css"> -->
    <!-- <link rel="stylesheet" href="../css/head_nav.css"> -->
    <link rel="stylesheet" href="../css/headpname.css">
    <link rel="stylesheet" href="../css/assignment.css">
</head>
<body>
<?php
    if($userType=="admin" || $userType=="foreman")
{?>
    <div class="assign_nav">
        <div class="assign_nav_inc">
            <?php
                include "../interface_nav.php";
                include "./header/header.php";
            ?>
        </div>
    <br>
    <?php
        if(!($userType=="user" || $userType=="foreman")){?>
        <div class="layout">
               <!-- <h1>State</h1> -->
               <a href="./foremanAssignProject.php?p_id=<?php echo $project_id; ?>" id="assign_user">Assign Foreman</a>
               <a href="./userAssignProject.php?p_id=<?php echo $project_id; ?>" id="assign_user">Assign User</a>
               </div> 
            <?php
            }?>
            <?php if(($userType=="foreman")){?>
        <div class="layout">
               <!-- <h1>State</h1> -->
            <a href="./userAssignProject.php?p_id=<?php echo $project_id; ?>" id="assign_user">Assign User</a>               </div> 
            <?php
            }?>
    
        <center><div Class="user_nav">User List</div></center>
        <div class='showuser'>
            <div class="usertableview">
            <?php
                include "./assigned_user.php";
            ?>
                <form action="" method="POST">
                    <table border="1">
                    <!-- php -->
                        <?php
                            $sn=1;
                            $query_users_view="SELECT * from users where role='user'";
                            $result_view=mysqli_query($conn,$query_users_view);
                            $num_view=mysqli_num_rows($result_view);
                            if($num_view>0)
                            {?>
                                <tr>
                                <th>Sn.</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Department</th>
                                <th>Assign</th>
                                </tr>
                                <?php
                                while($row=mysqli_fetch_assoc($result_view))
                                {
                                    $user_id=$row['id'];
                                    $fullname=$row['fullname'];
                                    $role=$row['role'];
                                    $dpt_id=$row['department_id'];
                                    ?>
                                    <tr>
                                        <td><?php echo  $sn ?></td>
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
                                        <td><input type="checkbox" name="checked_id[]" value="<?php echo $user_id; ?>" class="checkbox">
                                        <div class="show_assigned">
                                        <?php 
                                        if(!(empty($assigned_user_id)))
                                        {
                                            echo "Assigned";
                                        }
                                        ?>
                                        </div>
                                        </td>   
                                        <!-- <td><input type="submit" value="Assign" name="submit" class="btn_done"></td>                       -->
                                        <?php $sn++; ?>
                                    </tr>
                                <?php
                                }
                            }
                            else
                            {
                                echo "No Users Found.";
                            }
                        ?>
                    </table>
            </div>
            <div class="usersubmitview">
                <input type="submit" value="Assign" name="submit" class="btn_done">
                </form>
                <br><br>
                    <!-- submit Assigned Button -->
                <?php
                    if (isset($_POST["submit"])) 
                    {
                        if (!isset($_POST['checked_id'])) 
                        {
                            echo "Please Select Any User to Assign.";
                        } 
                        else if (isset($_POST['checked_id']) && is_array($_POST['checked_id'])) 
                        {
                            foreach ($_POST['checked_id'] as $checked_row_id) 
                            {
                                $checkAssignedUserQuery = "SELECT * FROM assigned_member WHERE project_id='$project_id' AND user_id='$checked_row_id'";
                                $AssignQueryResult = mysqli_query($conn, $checkAssignedUserQuery);
                                if (mysqli_num_rows($AssignQueryResult) > 0) 
                                {
                                    echo "UserId    ";
                                    echo $checked_row_id;
                                    echo "   has already assigned.";?><br><br><?php
                                } 
                                else 
                                {
                                    $insertUserIdQuery = "INSERT INTO assigned_member (project_id, user_id) VALUES ('$project_id','$checked_row_id')";
                                    $AssignResult = mysqli_query($conn, $insertUserIdQuery);
                                    if($AssignResult)
                                    {
                                        echo "UserId    ";
                                        echo $checked_row_id;
                                    echo "   has been assigned."; ?><br><br><?php
                                    }
                                    
                                }
                            }
                        }
                    }
                    ?>
            </div>
        </div>
    <?php
    }
    else
    { echo "Access Forbidden";
    }?>
</body>
</html>

