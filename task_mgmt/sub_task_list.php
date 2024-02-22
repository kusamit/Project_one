<?php
include '../dbconnect/dbconnect.php'; 
session_start();
$userType= $_SESSION["user_type"];
echo $userType;
include '../persistLogin.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="../css/subtasklist.css">
    </head>
    <body>
        <?php
        if($userType=="admin" || $userType=="foreman" || $userType=="user")
        {?>
           <!-- getting id of project and main task that has passed -->
            <?php
                // include 'dbconnect.php';
                $main_task_id = $_GET['main_task_id'];
                $project_id = $_GET['project_id'];
            ?>
            <div class="header">
                <!-- fetching the main task | Topics -->
            <div class="taskname"> <center>
                <?php
                        $sql = "SELECT * FROM main_task where Id='$main_task_id' and project_id='$project_id'";
                        $result_task = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result_task) > 0) {
                            echo "<table border='0'>
                        ";
                        $row = mysqli_fetch_assoc($result_task); 
                            echo "<tr>
                            <td style='padding: 10px;' class='taskname'>" . $row['name']  ."</td>
                            "
                            ?>
                        
                            <?php
                            "</td>
                            </tr>";
                        echo "</table>";
                        } else {
                        echo "No records found.";}?>
                        </center></div>

                <!-- for view -->
                <div class="view">

                    <!-- insert the Tasks -->
                <div class="insert" id="">
                
                    <form action="" method="POST">
                    <input type="text" name=insert placeholder="List the Tasks" required id="insert" >
                    <h4><?php echo '<p><strong>'?>

    <!-- For Current Time and Date -->
    <div id="reloadDiv">
        <p id="timeupdate">
            <?php
            date_default_timezone_set("Asia/Kathmandu");
            $now_timestamp = strtotime(date('Y-m-d H:i:s'));
            echo date('Y-m-d H:i:s');
            ?>
        </p>
    </div>

    <!-- java Script for Current time -->
    <script>
        function reloadDiv() {
            // Fetching updated time
            var currentDate = new Date();
            var hours = currentDate.getHours();
            var minutes = currentDate.getMinutes();
            var seconds = currentDate.getSeconds();
            var ampm = hours >= 12 ? 'PM' : 'AM';

            //12-hour format
            hours = hours % 12;
            hours = hours ? hours : 12; 
            var formattedTime = hours + ':' + (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds + ' ' + ampm;
            var updatedDate = new Date().toLocaleDateString();
            document.getElementById('timeupdate').innerHTML = "Current Date:    " + updatedDate + " <br><br>Current Time:    " + formattedTime;
        }
        setInterval(reloadDiv, 1000);    // 1-second reload
    </script>

                    <?php '</strong></p>'; ?></h4><br>
                    
                    <!-- deadline date -->
                    Deadline<input type="datetime-local" name="dt" id="" >
                    
                    <input type="submit" value="Add" name="submit" id="add" >
                    <!-- php for insertion of task -->
                    <?php
                        if(isset($_POST['submit']))
                        {
                            $insert=$_POST['insert'];
                            $datetime=$_POST['dt'];
                            if(!empty($datetime) && !empty($insert)){
                            $query="INSERT INTO sub_task_mgmt (message, main_task_id,project_id,end_date_time) 
                            values ('$insert', '$main_task_id','$project_id','$datetime') ";
                            $result=mysqli_query($conn,$query);
                            if($result)
                            {
                                // echo "$insert has been saved inthe List";  
                            }
                            else
                            {
                                echo "error";
                            }
                        }
                        else
                        {
                            echo "<h5>Please Enter Task Name and  Date-Time</h5>";
                        }
                    }
                        
                    ?>
                    </form>
                </div>

            <!-- task management View -->
            <form action="" method="POST" enctype="multipart/form-data">
    <p><b>Tasks</b></p>
    <hr>
    <table border="0">
    <tr>
        
    </tr>
    </table>
    <!-- to display the sub task  -->
    <?php
        $sql = "SELECT * FROM sub_task_mgmt WHERE main_task_id = '$main_task_id' and project_id='$project_id'";
        $result = mysqli_query($conn, $sql);
        // Check for errors in the query
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
        if (mysqli_num_rows($result) > 0) {
            $count = 1;?>
            <table border='0'>
            <tr>
            <th style="padding:0px;">Sn.</th>
                <th style="padding:0px;">Tasks</th>
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
        if (!function_exists('getDateTimeDiff')) 
        {
            function getDateTimeDiff($end_date_time) {
                date_default_timezone_set("Asia/Kathmandu");
                $now_timestamp = strtotime(date('Y-m-d H:i:s'));
                $end_timestamp = strtotime($end_date_time);
                $diff_timestamp = $end_timestamp - $now_timestamp;

                if ($diff_timestamp < 0) {
                    return 'expired';
                } elseif ($diff_timestamp < 60) {
                    return 'few seconds left';
                } elseif ($diff_timestamp >= 60 && $diff_timestamp < 3600) {
                    return round($diff_timestamp / 60) . ' mins left';
                } elseif ($diff_timestamp >= 3600 && $diff_timestamp < 86400) {
                    return round($diff_timestamp / 3600) . ' hours left';
                } elseif ($diff_timestamp >= 86400 && $diff_timestamp < (86400 * 30)) {
                    return round($diff_timestamp / (86400)) . ' days left';
                } elseif ($diff_timestamp >= (86400 * 30) && $diff_timestamp < (86400 * 365)) {
                    return round($diff_timestamp / (86400 * 30)) . ' months left';
                } else {
                    return round($diff_timestamp / (86400 * 365)) . ' years left';
                }
            }
        } 
    //fetch subtask from the database
    while ($row = mysqli_fetch_assoc($result)) {
            $msg = $row['message'];
            $end_time = $row['end_date_time'];
            $rowId = $row['Id'];
            $progress_percentage = $row['progress_percentage'];
            $progress_status = $row['progress'];
            $fetched_remarks=$row['remarks'];
            // $completed = $row['completed'];
            $completed = $row['review'];
            $suspend=$row['suspend'];
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
            </td>
            <!-- progress display -->
            <td>
                <?php 
                    if ($completed == 1) {
                        echo "<p style='background-color:#00e600;' class='btn'>Submitted In-Review</p>";
                    } else if ($progress_status == 1) {
                        echo "<p style='background-color:#ffdb4d;' class='btn'>In-Progress</p>";
                    } else if ($suspend == 1) {
                        echo "<p style='background-color:#ff5c33;' class='btn'>Progress Suspended</p>";
                    } else if ($completed == NULL && $progress_status == NULL && $suspend == NULL) {
                        echo "";
                    }
                ?>
            </td>
            <!-- file display -->
            <td>
                <input type="file" name="doc" id="file" >
            </td>
            <!-- display remarks -->
            <td>
                <?php if($fetched_remarks!=="undefined")
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
                <form action="" method="POST" class="action_form">
                    <?php if(getDateTimeDiff($end_time) !== "expired"): ?>
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
                    <textarea type="text" name="remark" placeholder="Remarks" class="remarks"></textarea>
                
                <?php endif; ?>
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
    </form>

    <!-- JavaScript code -->
    <script>

    function getValueAsync(selector) {
        return new Promise(resolve => {
            var element = document.querySelector(selector);
            resolve(element ? element.value : '');
        });
    }
        
    async function updateStatus(rowId, status) {
        try{
            var progress = await getValueAsync("#row_" + rowId + " #progress_select");
            var remarks = await getValueAsync("#row_" + rowId + " .remarks");

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = xhr.responseText;
                    console.log(response);            
                }
            } 
            xhr.open('POST', "update_status.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            
            if(status === "progress"){
                xhr.send("rowId=" + rowId + "&status=" + status+"&progress="+progress);
            }
            else{
                xhr.send("rowId=" + rowId + "&status=" + status+"&remarks=" + remarks);
            }
        }
        catch (error) {
            console.error("An error occurred:", error);
        }
        
    }

    </script> 
        <?php
        }?>
        
    </body>
</html>