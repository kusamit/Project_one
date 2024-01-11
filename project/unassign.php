<?php
include '../dbconnect/dbconnect.php';

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
  

    // Check if $id is set and not an empty string
    if ($id !== "") {
      
        $sql = "UPDATE assigned_member SET isAssigned = 0  WHERE user_id = $id";
        
        $result = mysqli_query($conn, $sql);
       if($result){
        echo "user unassigned";
       }
        
    } else {
        echo "Error: Empty or invalid 'id' parameter";
    }
} else {
    echo "Error: Invalid request method or 'id' parameter not set";
}
?>
