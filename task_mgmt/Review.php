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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* background-color: #f0f0f0; */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 3rem;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #e2e2e2;
        }
        a {
            text-decoration: none;
            color: blue;
        }
        a:hover {
            text-decoration: underline;
        }
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
    <!-- </table> -->
    <?php
    $select_review = "SELECT * FROM sub_task_mgmt WHERE main_task_id='$main_task_id' AND project_id='$project_id'";
    $result_review = mysqli_query($conn, $select_review);
    $num = mysqli_num_rows($result_review);
    if ($num > 0) {
        $sn = 0;
        while ($fetched_review = mysqli_fetch_assoc($result_review)) {
            $fetched_id = $fetched_review['Id'];
            $fetched_message = $fetched_review['message'];
            $fetched_deadline = $fetched_review['end_date_time'];
            $fetched_progress_percentage = $fetched_review['progress_percentage'];
            $fetched_remarks = $fetched_review['remarks'];
            $fetched_file = $fetched_review['fileupload'];
            $fetched_review_flag = $fetched_review['review']; // Use a different variable to store the review flag
            $fetched_isvarified = $fetched_review['isvarified'];
            $sn++;
        }

        if ($fetched_review_flag == 1) {
        ?>
            <!-- <table border='1'> -->
                <tr>
                    <td><?php echo $sn; ?></td>
                    <td><?php echo $fetched_message; ?></td>
                    <td><?php echo $fetched_deadline; ?></td>
                    <td><?php echo $fetched_progress_percentage; ?></td>
                    <td><?php echo $fetched_remarks; ?></td>
                    <td><?php echo $fetched_file; ?></td>
                    <td><a href="verify.php">Verify</a></td>
                    <td><a href="redo.php">Redo</a></td>
                </tr>
            </table>
        <?php
        }
    }
}
?>
</body>
</html>
