 <!-- getting id of project and main task that has passed -->
 <?php
        // include 'dbconnect.php';
        $main_task_id = $_GET['main_task_id'];
        $project_id = $_GET['project_id'];
?>
            <div class="top_nav">
            <?php if($userType=="user"){ ?>
            <a href="../project/project_details.php?user_type=<?php echo $userType; ?>&id=<?php echo $project_id; ?>&user_id=<?php echo $user_admin_id ?>" class="top_nav_bar">Back</a></h4>
            <?php }
            else{ ?>
            <a href="../project/project_details.php?user_type=<?php echo $userType; ?>&id=<?php echo $project_id; ?>" class="top_nav_bar">Back</a></h4>
            <?php }?>
            <a href="../interface.php" class="top_nav_bar">Home</a>
            <h2 class="dashboard">Task Management</h2>
        </div>
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
                            <td class='taskname'><divclass='taskname'>" . $row['name']  ."</div></td>
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
    <?php include './js/currenttimefunction.php'; ?>
                    <?php '</strong></p>'; ?></h4><br>
                    
                    <!-- deadline date -->
                    Deadline<input type="datetime-local" name="dt" id="inputdata" >
                    
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
