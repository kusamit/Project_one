<?php
include '../dbconnect/dbconnect.php'; 
session_start();
$user_admin_id=$_SESSION['Login_session'];
$userType= $_SESSION["user_type"];
$project_id = $_GET['project_id'];
// echo $userType;
include '../persistLogin.php';
?>
<html>
    <title>Task</title>
    <head>
        <link rel="stylesheet" href="../css/subtasklist.css">
        <link rel="stylesheet" href="../css/headpname.css">
        <!-- <link rel="stylesheet" href="../css/project_details.css"> -->
    </head>
    <body>
        <?php
        if($userType=="admin" || $userType=="foreman" || $userType=="user")
        {
            ?>
        <!-- fetched topic and insert of tasks -->
            <?php 
            include '../interface_nav.php';
            include '../Assignment/header/header.php';
            include 'topic_insert.php'; 
          ?>
          
            <!-- task management View -->
    <table border="0">
        <tr>
            <p><b>Tasks</b></p>
            <hr>
        </tr>
    </table>
    <!-- to display the sub task  -->
    <?php
    include './js/validmaintaskdate.php';
    // include './js/daterange.php';
        $sql = "SELECT * FROM sub_task_mgmt WHERE main_task_id = '$main_task_id' and project_id='$project_id'";
        $result = mysqli_query($conn, $sql);
        // Check for errors in the query
        if (!$result) 
        {
            die("Query failed: " . mysqli_error($conn));
        }
        if (mysqli_num_rows($result) > 0) 
        {
        ?>
            <table border='0'>
            <tr>
                <th>Sn.</th>
                <th>Tasks</th>
                <th>Deadline</th>
                <th>Expiry</th>
                <th>Progress Percentage</th>
                <th>Progress</th>
                <th>Progress Report</th>
                <th>Remarks</th>
                <th>Action</th>
                <th>Controls</th>
            </tr>
        <?php
        $count = 1; // Initialize the count variable

        // Check condition function is not already defined the date and time
        include './js/checkdatetimefunction.php';
    //fetch subtask from the database
    while ($row = mysqli_fetch_assoc($result)) {
            $msg = $row['message'];
            $end_time = $row['end_date_time'];
            $rowId = $row['Id'];
            $progress_percentage = $row['progress_percentage'];
            $progress_status = $row['progress'];
            $fetched_remarks=$row['remarks'];
            $completed = $row['completed'];
            $review = $row['review'];
            $fetched_file=basename($row['fileupload']);
            $suspend=$row['suspend'];
            $status_tsbmt = "";
            $isvarified=$row['isvarified'];
            // echo $isvarified;
               // Check if form submitted for this row
               if (isset($_POST['done']) && $_POST['row_id'] == $rowId) {
                $status_tsbmt = "Task Submitted";
            }
        ?>
        <tr id="row_<?php echo $rowId; ?>">
            <td style='padding: 10px;'><?php echo $count; ?></td>
            <!-- subtask display -->
            <td style='padding: 10px; max-width:15rem;'><?php echo $msg; ?></td>
                <!-- endtime Display -->
            <td><?php echo $end_time; ?></td>
            <td>
                <?php
                echo '<p> ' . getDateTimeDiff($end_time) . '</p>';
                ?>
            </td>
            <td>
                <p><?php echo $progress_percentage!=0 ? $progress_percentage:''; ?></p>
                <?php 
                    if($isvarified==2 && $review==2)
                    {
                        echo "100 % Completed";
                    }
                    ?>
            </td>
            <!-- progress display -->
            <td>
                <?php 
                    if($isvarified==1 && $review==1)
                    {
                        echo "<p style='background-color:#00e600;' class='btn'>Task Submitted InReview</p>";
                    }
                    if($isvarified==2 && $review==2)
                    {
                        echo "<p style='background-color:#00e600;' class='btn'>Varified</p>";
                    }
                    else if ($completed == 1) {
                        echo "<p style='background-color:#00e600;' class='btn'>Completed</p>";
                    } else if ($progress_status == 1) {
                        echo "<p style='background-color:#ffdb4d;' class='btn'>In-Progress</p>";
                    } else if ($suspend == 1) {
                        echo "<p style='background-color:#ff5c33;' class='btn'>Progress Suspended</p>";
                    } else if ($completed == NULL && $progress_status == NULL && $suspend == NULL) {
                        echo "";
                    }elseif ($review == 1) {
                        echo "<p style='background-color:#00e600;' class='btn'>In-Review</p>";
                    }
                ?>
            </td>
            <!-- file display -->
            <form action="" method="POST" enctype="multipart/form-data">
            <td><div id="inputdata" >
                <input type="file" name="file" ><?php echo $fetched_file;?>
            </div>
            </td>
            <!-- display remarks -->
            <td>
                <?php 
                if($fetched_remarks!=="undefined")
                    {
                        echo $fetched_remarks;
                    }
                    else
                    {
                        echo "None";
                    } ;  
                ?>
            </td>
            <!-- to display action -->
            <td>
                <!-- <form action="" method="POST" class="action_form"> -->
                    <?php if(getDateTimeDiff($valid_deadline) !== "expired"): 
                    if(getDateTimeDiff($end_time) !== "expired"):
                        if(!($isvarified==2 && $review==2)){ ?>
                    <select name="" id="progress_select" class="btn_p">
                        <option value="0">Select</option>
                        <option value="5">5%</option>
                        <option value="15">15%</option>
                        <option value="25">25%</option>
                        <option value="50">50%</option>
                        <option value="75">75%</option>
                        <option value="90">90%</option>
                        <option value="100">100%</option>
                    </select>
                    <button name="action_btn_inprogress" class="btn_p" onclick="updateStatus('<?php echo $rowId; ?>', 'progress')">
                        Progress
                    </button>
                    <button name="action_btn"class="btn_s" onclick="updateStatus('<?php echo $rowId; ?>', 'suspend')" >Suspend</button>
                    <button name="action_btn" class="btn_c" onclick="updateStatus('<?php echo $rowId; ?>', 'completed')">Completed</button>
                    <textarea type="text" name="remark" placeholder="Remarks" class="remarks"></textarea><br>
                    <input type="hidden" name="row_id" value="<?php echo $rowId; ?>">
                    <input type="submit" value="Submit Task" name='done' class='file_sbmt'><br>
                    <?php echo $status_tsbmt; }?>
                <?php endif; 
                endif;?>
                </form>
            <hr>
            </td>
            <td>
                <!-- Edit and Delete Controls -->
                <a href='update_sub_task.php?id=<?php echo $rowId;?>&main_task_id=<?php echo $main_task_id;?>&project_id=<?php echo $project_id;?>' class="control">
                <img src='edit.png' alt='image' title='Edit'></a>
                <?php
                if(!($userType=="user"))
                {?>
                    <a href='delete_sub_task.php?id=<?php echo $rowId;?>&main_task_id=<?php echo $main_task_id;?>&project_id=<?php echo $project_id;?>'>
                    <img src='delete.png' alt='image' title='Delete'class="control_img">
                    </a>
                <?php
                }?>
                
                <hr>
            </td>
        </tr>
        <?php
        $count++;
    }
    ?>
    </table>
    <?php
    } 
    else {
        echo "No records found.";
    }
    ?>
    <!-- </form> -->
    <?php
    if(isset($_POST['done']))
    {
        $rowIdToUpdate = $_POST['row_id'];
                     
        $file = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];
        $folder = './sub_task_file/' . $file;
        if (move_uploaded_file($temp, $folder)) {
            // echo $folder;
            // echo "File for Row ID $rowIdToUpdate uploaded successfully.";
            $file_query="UPDATE sub_task_mgmt SET fileupload='$folder', isvarified='1',review='1' where id='$rowIdToUpdate'";
            $resultfileupdate=mysqli_query($conn,$file_query);
            if($resultfileupdate)
            {
                // echo $folder;
                $status_tsbmt="Task Submitted";
            }
            else
            {
                echo "Error ";
            }
        } else {
            $file_query="UPDATE sub_task_mgmt SET isvarified='1', review='1' where id='$rowIdToUpdate'";
            $resultfileupdate=mysqli_query($conn,$file_query);
            if($resultfileupdate)
            {
                // echo  $rowIdToUpdate;
                $status_tsbmt="Task Submitted";
            }
            else
            {
                echo "Error ";
            }
        }
    }
    ?>
    <!-- JavaScript code -->
    <?php include './js/updatefunctionpass.php'; ?>
        <?php
        }?>
        
    </body>
</html>