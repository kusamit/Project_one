<?php
// include '../session.php';
include '../dbconnect/dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body
    {
        margin:0px;
        padding:0px;
    }
    #project_name{
        margin-left:20px;
        /* padding:10px; */
        font-size:25px;
        /* background-color: #664d00; */
        color:#191966;
        border-radius:3px;
    }
    #project_details
    {
        width:50%;
        margin-top:10px;
        /* color:#191966; */
        background-color: #bbbb77;
        border-radius:2px;
    }
    .project_info
    {
        background-color:#b2b266;  
    }
    #details
    {
        font-size:20px;
        /* margin-bottom:10px; */
        margin-left:20px;
        padding:5px;
        font-style:bold;
        color:#551A8B;
        border-radius:3px;
    }
    #msg
    {
        font-size:15px;
        text-align:justify;
    }
    #file
    {
        text-align:center;
        align-items:center;
    }
    #view_file
    {
        font-size:12px;
    }
    .topics
    {
        /* margin-top:4rem; */
        padding:10px;
        font-size:20px;
        font-weight:bold;
        text-decoration:none;
        background-color:lightgrey;
        width:fit-content;
        border-radius:5px;
        height:fit-content;
        color:#551A8B;
    }
    .topics_View_nav
    {
        background-color:#d1e0e0;
        width:100%;
        height:fit-content;
        text-align:center;
    }
    a
    {
        color:#551A8B;
        text-decoration:none;
    }
    a:hover
    {
        border-radius:5px;
    }
    .main
    {
        margin:0px;
        max-width: 100vw;
        border: 1px solid grey;
        padding: 0px;
        /* margin-left:20px; */
        padding:0px;
        border:0px;
        
    }
    .info_body
    {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
    }
    .left
    {
        flex: 5;
    }
    .assign_user
    {
        padding: 20px;
        text-align: center;
        flex: 4;
        display:flex;
    }
    .detailed_info_right
    {
        flex: 9.5;
        border:0px;
        direction:right;
        max-width: 100vw;
        border: 0px;
        padding: 10px;
        margin-left:20px;
        padding:10px;
    }
    #assign_user,#assign_supervisor
    {
        margin:5px;
        margin-top:4rem;
        padding:5px;
        font-size:20px;
        text-decoration:none;
        background-color:whitesmoke;
        width:fit-content;
        height:fit-content;
        border-radius:5px;
        color:#551A8B;
    }
    .topic_box
    {
        background-color:whitesmoke;
        height:max-content;
        width:12rem;
        margin-top:15px;
        margin:10px;
        padding-top:15px;
        text-align:center;
        font-weight:bold;
        border: 1px solid #d1d1e0; 
        border-radius:10px;
        display: flex; 
        flex-direction:row;
        justify-content: space-between;
        
    }
    .topic_box_content
    {
      display: flex;
      flex-direction: column;
      width:70%,30%;
      align-items: center;
      justify-content: center;
    }
    .action_UD
    {
        margin:5px;
        /* background-color: #d1e0e0; */
        color:blue;
        font-size:10px;
        padding:5px;
        border-radius:10px;
    }
    td
    {
        font-size:10px;
        color:black;
        text-align:center;
    }
    th
    {
        font-size:15px;
        text-align:center;
    }
    .view_topics
    {
        display: flex; 
        flex-wrap: wrap;
    }
    h4{
        margin:0px;
        padding:0px;
    }
    .p_n{
        font-size:15px;
        margin-left:25px;
        padding:5px;
    }
</style>
<body>
<div class="main">
    <table border="0">
        <!-- fetching project name and details      -->
        <div class="project_info">
                <?php
                if (isset($_GET['id'])) {
                    $project_id = $_GET['id'];
                    echo $project_id;
                ?>
            <?php
            $sql="select * from project where id=$project_id" ;
            $result_view=mysqli_query($conn,$sql);
                if($result_view)
                    {
                        echo "";
                    }
                else
                    {
                        echo "error database connection";
                    }
            // Fetched details from the project table
            $num_view=mysqli_num_rows($result_view);
            $row_view=mysqli_fetch_assoc($result_view);
            $fetched_id=$row_view['id'];
            // echo $fetched_id;
            $fetched_file_type=$row_view['file_type'];
            $fetched_file=$row_view['file'];
            $fetched_project_details=$row_view['project_details'];
            ?>
            <!-- View project Name and Details HTML -->
            <div id="project_name">
                <h4 class="p">Project Name <br>
                <h4 class="p_n"><?php echo $row_view['project_name'] ;?></h4></h4>
            </div>
            <!-- Project Details HTML -->
            <div id="project_details">
                <div id="details">
                    Project Details
                </div>
            </div>
        </div>  
    <div class="info_body">
        <div class="detailed_info_right">
                    <!-- details_Info -->
            <div id='msg'>
                <?php echo $fetched_project_details; ?>
            </div>
        </div>
                <!-- sub details and files left side -->
    <div class="left">
        <div id="file">
            <div id="project_file">
                <?php if($fetched_file_type==1){ ?>
                <a href="fullimg.php?url=<?php echo $row_view['file'] ; ?>?type=<?php echo $fetched_file_type; ?>">
                <img style="height:10rem; width:7rem;" src="<?php echo $row_view['file'] ; ?>"><p id="view_file">View Image</p>
                </a>
                <?php } elseif($fetched_file_type==2){?>
                <a href="fullpdf.php?url=<?php echo $row_view['file'] ; ?>?type=<?php echo $fetched_file_type; ?>">
                <embed style="height:10rem; width:7rem;" src="<?php echo $row_view['file']; ?>" type="application/pdf" /><p id="view_file">View PDF</p>
                </a>
                <?php 
                }?>
            </div>
        </div>
    </div>
        <div class="assign_user">
            <a href="../Assignment/userAssignProject.php?p_id=<?php echo $project_id; ?>" id="assign_user">Assign Users</a>
            <a href="../Assignment/foremanAssignProject.php?p_id=<?php echo $project_id; ?>" id="assign_supervisor">Assign Supervisor</a>
            <div>
    <!-- closing of project info php -->
    <?php
    }
    ?>
    </table>
    <!-- Main tasks or topics -->
    <div class="topics">
        <a href="../task_mgmt/create_main_task.php?project_id=<?php echo $project_id; ?>">Create Main Task | Topics</a>
    </div>
    <div class="topics_View_nav">
        <p Class="">Main Task | Topics</p>
    </div>
    <!-- Fetch Topics | Main Tasks -->
    <div class="taskname">
    <center>
    <?php
    // include 'dbconnect.php';
    $sql = "SELECT * FROM main_task where project_id=$project_id";
    $result_task = mysqli_query($conn, $sql);
    $num_topic = mysqli_num_rows($result_task);

    if ($num_topic > 0) {
        while ($row_task = mysqli_fetch_assoc($result_task)) {
            $fetched_main_task_id = $row_task['Id'];
            $fetched_Topic_name = $row_task['name'];
            $fetched_topic_deadline = $row_task['deadline'];
            $fetched_assigned_userId = $row_task['user_id'];

            // to fetch name of the assigned user in the topic
            $sql_user = "SELECT * FROM users where id=$fetched_assigned_userId";
            $result_user = mysqli_query($conn, $sql_user);
            $num_user = mysqli_num_rows($result_user);

            if ($num_user > 0) {
                while ($row_user = mysqli_fetch_assoc($result_user)) {
                    $fetched_user_name = $row_user['fullname'];
                }
            }

            // Box for choosing the Main Tasks | Topics
            echo "<a href='../task_mgmt/sub_task_list.php?main_task_id=".$fetched_main_task_id."&project_id=".$project_id."'>
                <div class='view_topics'>";
            echo "<div class='topic_box'>";
            ?>
            <div class='topic_box_content'>
                <table border=0>
                    <tr><th><?php echo "Name"; ?></th></tr>
                    <tr><td><?php echo $fetched_Topic_name; ?></td></tr>
                    <tr><th><?php echo "Assigned User"; ?></th></tr>
                    <tr><td><?php echo $fetched_user_name; ?></td></tr>
                    <tr><th><?php echo "Deadline"; ?></th></tr>
                    <tr><td><?php echo $fetched_topic_deadline; ?></td></tr>
                </table>
            </div>
            <div class='topic_box_content'>
                <a href="#1" class="action_UD">Update</a>
                <a href="#2" class="action_UD">Delete</a>
                <!-- <a href="#3" class="action_UD">Completed</a> -->
            </div>
            <?php
            echo "</div>";
        }

        echo "</div>";
    } else {
        echo "No records found.";
    }
?>
    </center>
</div>

</div>
</body>
</html>
