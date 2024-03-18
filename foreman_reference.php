<?php
session_start();
include './dbconnect/dbconnect.php';
$userType= $_SESSION["user_type"];
// echo $userType;
include './persistLogin.php';
$project_id = $_GET['p_id'];            //getting project id
// echo $project_id;
?>
<?php
    $query_assigned_view="SELECT * from assigned_member where project_id='$id'";
    $result_assigned=mysqli_query($conn,$query_assigned_view);
    $num_assigned=mysqli_num_rows($result_assigned);
    if($num_assigned>0)
        {?>
        <?php
            while($row=mysqli_fetch_assoc($result_assigned))
            {
                $assigned_foreman_id=$row['foreman_id'];
            }
            // echo $assigned_foreman_id;
            if(($assigned_foreman_id=='0'))
            {
                echo "No Assigned Foreman Found.";
            }
            else if(!($assigned_foreman_id=='0'))
            {
                $query_foreman_view="SELECT * from users where id='$assigned_foreman_id'";
                $result_view=mysqli_query($conn,$query_foreman_view);
                $num_view=mysqli_num_rows($result_view);
                if($num_view>0)
                {
                    while($row=mysqli_fetch_assoc($result_view))
                    {
                        $user_id=$row['id'];
                        // echo $user_id;
                        $fullname=$row['fullname'];
                        echo $fullname;
                    }
                }
            }
        }
                // }
                ?>
                <tr>
