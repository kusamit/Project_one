<?php
include '../dbconnect/dbconnect.php';

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $dname = mysqli_real_escape_string($conn, $_POST['dname']);
    $did = mysqli_real_escape_string($conn, $_POST['did']);

    // Check if $id is set and not an empty string
    if ($id !== "") {
        
        $check = "Select * from assigned_member where user_id = '$id'";
        $resCheck = mysqli_query($conn,$check);
        $nums = mysqli_num_rows($resCheck);
        echo $nums;
        if($nums>0){
            $sql = "UPDATE assigned_member SET isAssigned = 1  WHERE user_id = $id";
            echo "user assigned";
        }else{
            $sql = "INSERT INTO assigned_member (user_id, project_id, manager_id,isAssigned) VALUES ('$id', '$did', '$dname',1)";
            mysqli_query($conn, $sql);
            echo "user assigned";
        }

        
       
    } else {
        echo "Error: Empty or invalid 'id' parameter";
    }
} else {
    echo "Error: Invalid request method or 'id' parameter not set";
}
?>
