<?php
include '../dbconnect/dbconnect.php'; 
session_start();
$userType = $_SESSION["user_type"];
$user_admin_id = $_SESSION['Login_session'];
$project_id = $_GET['project_id'];
include '../persistLogin.php';
$main_task_id = $_GET['main_task_id'];
$user_id = $_GET['user_id'];
$sub_task_id=$_GET['id'];
echo $sub_task_id;

if ($userType !== "user") {
    $update_review = "UPDATE sub_task_mgmt SET isvarified=0, review=0 WHERE main_task_id='$main_task_id' 
    AND project_id='$project_id' AND isvarified='1' AND review='1' and Id='$sub_task_id'";
    $result_update = mysqli_query($conn, $update_review);
    if(!$result_update) {
        echo "Verification Failed: " . mysqli_error($conn);
    } else {
        echo "<script>alert('Redo Sent successfully');</script>";
        header("Refresh:0;url='./Review.php?id=".$main_task_id."&user_id=" . $user_id . "&project_id=" . $project_id . "'");
    }
}
?>
