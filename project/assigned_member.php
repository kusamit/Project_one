<?php
include '../dbconnect/dbconnect.php';

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $dname = mysqli_real_escape_string($conn, $_POST['dname']);
    $did = mysqli_real_escape_string($conn, $_POST['did']);

    // Check if $id is set and not an empty string
    if ($id !== "") {
        include 'insertFirst.php';
        $sql = "INSERT INTO assigned_member (user_id, project_id, manager_id,isAssigned) VALUES ('$id', '$did', '$dname','$status')";
        if($status==1){
            file_put_contents('insertFirst.php', '<?php $status = 0;?>');
        }else{
            file_put_contents('insertFirst.php', '<?php $status = 1;?>');

        }
        mysqli_query($conn, $sql);
        echo "user assigned";
        exit();
    } else {
        echo "Error: Empty or invalid 'id' parameter";
    }
} else {
    echo "Error: Invalid request method or 'id' parameter not set";
}
?>
