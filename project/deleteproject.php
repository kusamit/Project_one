<?php
include '../dbconnect/dbconnect.php'; 
session_start();
$userType= $_SESSION["user_type"];
// echo $userType;
include '../persistLogin.php';
?>
<?php
if($userType=='admin')
{
    include 'dbconnect.php';
    // $id = $_GET['id'];
    // $main_task_id = $_GET['main_task_id'];
    $project_id = $_GET['p_id'];
    $query="DELETE FROM project where id=$project_id";
    $result=mysqli_query($conn,$query);
    if($result)
        {
            header('Location: ../interface.php');
        }
        else
        {
            echo "error";
        }
}
                    
?>