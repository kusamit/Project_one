<?php
include '../dbconnect/dbconnect.php'; 
session_start();
$userType= $_SESSION["user_type"];
$project_id = $_GET['p_id'];  
// echo $userType;
include '../persistLogin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Project</title>
    <!-- <link rel="stylesheet" href="../css/assignment.css"> -->
    <!-- <link rel="stylesheet" href="../css/project.css"> -->
    <!-- <link rel="stylesheet" href="../css/interface.css"> -->
    <link rel="stylesheet" href="../css/project_details.css">

</head>
<body>
<?php
if($userType=='admin')
{?>
    <div class="topcolor">
        <?php include '../Assignment/header/header.php'; //top nav ?>
    </div>
  <?php  
    include '../dbconnect/dbconnect.php';
    $project_id = $_GET['p_id'];
    $query="select * FROM project where id=$project_id";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)> 0)
    {
        $row=mysqli_fetch_assoc($result);
        $project_id=$row['id'];
        $project_name=$row['project_name'];
        // echo $file_t=$row['file_type'];
        $project_cost=$row['cost'];
        $existingfile=$row['file'];
        $project_details=$row['project_details'];
        $project_deadline=$row['deadline'];
?>
    <center><h3>Update Project Details</h3>
        <div id="project_update">
            <form action="" method="POST" id="formp" enctype="multipart/form-data">
                    
                <span>Project Name</span>
                <span><input type="text" name="project" id="project" Value="<?php echo $project_name; ?>" required class="p_create"></span>
                <span>File Type</span>
                <span><select name="f_type" class="p_create">
                    <option value="1">image</option>
                    <option value="2">pdf</option>
                </select><?php echo basename($existingfile); ?></span>
                <span><input type="file" name="file" id="project_file" Value="<?php echo $project_name; ?>"   class="p_create"></span>
                <span>Cost</span> <span>
                <input type="number" name="cost" Value="<?php echo $project_cost; ?>" class="p_create"></span>
                <span>Deadline</span>
                <span><input type="datetime-local" name="dt" id="" Value="<?php echo $project_deadline; ?>" class="p_create" required></span>
                <span>Details</span>
                <span><textarea name="p_details" id="project" cols="" rows="" Value="<?php echo $project_details; ?>" class="p_create"></textarea></span><br><br>
                <span><input type="submit" value="Create" name="submit" id="submit_project" ></span> 
            </form>
        </div>
</center>
    <?php
    }
}
?>
</body>
</html>



