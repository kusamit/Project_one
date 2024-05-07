<?php
include '../dbconnect/dbconnect.php'; 
session_start();
$userType = $_SESSION["user_type"];
$user_admin_id = $_SESSION['Login_session'];
$project_id = $_GET['project_id'];
include '../persistLogin.php';
$main_task_id = $_GET['id'];
$user_id = $_GET['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review</title>
    <link rel="stylesheet" href="../css/headpname.css">
    <link rel="stylesheet" href="../css/review.css">
    <style>
        
    </style>
</head>
<body>
<?php
if (!($userType == "user")) {
    include '../interface_nav.php';
    include '../Assignment/header/header.php';
?>
    <table border='1'>
        <tr>
            <th>ID</th>
            <th>Task</th>
            <th>Deadline</th>
            <th>Progress</th>
            <th>Remarks</th>
            <th>File</th>
            <th colspan="2">Review</th>
        </tr>
        <?php
        $select_review = "SELECT * FROM sub_task_mgmt WHERE main_task_id='$main_task_id' AND project_id='$project_id'";
        $result_review = mysqli_query($conn, $select_review);
        $sn = 0;

        while ($fetched_review = mysqli_fetch_assoc($result_review)) {
            $sn++;
            $fetched_id = $fetched_review['Id'];
            $fetched_message = $fetched_review['message'];
            $fetched_main_task_id = $fetched_review['main_task_id'];
            $fetched_project_id = $fetched_review['project_id'];
            $fetched_deadline = $fetched_review['end_date_time'];
            $fetched_progress_percentage = $fetched_review['progress_percentage'];
            $fetched_remarks = $fetched_review['remarks'];
            $fetched_file =  basename($fetched_review['fileupload']);
            $fetched_reviews = $fetched_review['review'];
            $fetched_isvarified = $fetched_review['isvarified'];
            
            if ($fetched_reviews == '1' && $fetched_isvarified == '1') {
                ?>
                <tr> 
                    <td><?php echo $sn; ?></td>
                    <td><?php echo $fetched_message; ?></td>
                    <td><?php echo $fetched_deadline; ?></td>
                    <td><?php echo $fetched_progress_percentage; ?></td>
                    <td><?php echo $fetched_remarks; ?></td>
                    <td>

                        <?php 
                            $file_extension = strtolower(pathinfo($fetched_file, PATHINFO_EXTENSION));
                            if(in_array($file_extension, array('jpg', 'jpeg'))) { ?>
                                <a class="imgpdf" href="fileviewer.php?url=<?php echo $fetched_review['fileupload']; ?>&type=<?php echo $file_extension; ?>">
                                <?php 
                        echo $fetched_file;
                        ?>
                                </a>
                            <?php } elseif($file_extension == 'pdf') { ?>
                                <a class="imgpdf" href="fileviewer.php?url=<?php echo $fetched_review['fileupload']; ?>&type=<?php echo $file_extension; ?>">
                                <?php 
                                    echo $fetched_file;
                                ?>
                                </a>
                            <?php } 
                            ?>
                    </td>
                    <td><a href="./verify.php?id=<?php echo $fetched_id; ?>&project_id=<?php echo $fetched_project_id; ?>&main_task_id=<?php echo $fetched_main_task_id; ?>&user_id=<?php echo $user_id; ?>">Verify</a></td>
                <td><a href="./redo.php?id=<?php echo $fetched_id; ?>&project_id=<?php echo $fetched_project_id; ?>&main_task_id=<?php echo $fetched_main_task_id; ?>&user_id=<?php echo $user_id; ?>">Redo</a></td>
                </tr>
                <?php
            }
        }
        ?>
    </table> 
    <?php
} else {
    echo "Access Forbidden";
}
?>
</body>
</html>
