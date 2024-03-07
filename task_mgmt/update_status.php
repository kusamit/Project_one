<?php
include 'dbconnect.php';


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $rowId = intval(mysqli_real_escape_string($conn, $_POST['rowId']));
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
    $progress = mysqli_real_escape_string($conn, $_POST['progress']);

    if($status === "progress"){
        $update_percentage = "progress_percentage='".$progress."'";
    }
    else{
        $update_percentage = "remarks='".$remarks."'";
    }
    echo $remarks;
    echo gettype($rowId);

    // Update the database based on the button clicked
    switch ($status) {
        case 'progress':
            mysqli_query($conn, "UPDATE sub_task_mgmt SET progress = 1, completed=0, review=0,suspend=0, $update_percentage WHERE Id = $rowId");
            break;
        case 'completed':
            mysqli_query($conn, "UPDATE sub_task_mgmt SET progress = 0, completed=1, review=0,suspend=0, $update_percentage  WHERE Id = $rowId");
            break;
            case 'suspend':
                mysqli_query($conn, "UPDATE sub_task_mgmt SET progress = 0, completed=0, review=0,suspend=1, $update_percentage WHERE Id = $rowId");
                break;
    }

    // You can send a response if needed
    echo "Status updated successfully";
    
} 
else {
    // Handle invalid requests
    echo "Invalid request";
}
?>
