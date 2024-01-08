<?php
include 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $rowId = intval(mysqli_real_escape_string($conn, $_POST['rowId']));
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    echo gettype($rowId);

    // Update the database based on the button clicked
    switch ($status) {
        case 'progress':
            mysqli_query($conn, "UPDATE list_msg SET progress = 1, completed=0, review=0,suspend=0 WHERE Id = $rowId");
            break;
        case 'completed':
            mysqli_query($conn, "UPDATE list_msg SET progress = 0, completed=0, review=1,suspend=0 WHERE Id = $rowId");
            break;
            case 'suspend':
                mysqli_query($conn, "UPDATE list_msg SET progress = 0, completed=0, review=0,suspend=1 WHERE Id = $rowId");
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
