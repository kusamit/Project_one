<?php
include '../dbconnect/dbconnect.php'; 
session_start();
$userType= $_SESSION["user_type"];
echo $userType;
include '../persistLogin.php';
?>
<?php
    if($userType=='admin')
    {
        // include 'dbconnect.php';
        $main_task_id = $_GET['id'];
        $user_id = $_GET['user_id'];
        $project_id = $_GET['project_id'];
        $query="DELETE FROM main_task where Id='$main_task_id' ";
        $result=mysqli_query($conn,$query);
            if($result)
            {
                header('Location:../project/project_details.php?id='.$project_id);
                // echo "deleted sucess";
            }
            else
            {
                echo "error";
            }
    }
                    
?>