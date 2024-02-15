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
    #project_name{
        margin-left:20px;
        padding:10px;
        font-size:35px;
        /* background-color: #664d00; */
        color:white;
        border-radius:3px;
    }
    #project_details
    {
        width:50%;
        margin-top:10px;
        background-color:#664d00;
        border-radius:2px;
    }
    .project_info
    {
        background-color:#b2b266;  
    }
    #details
    {
        font-size:25px;
        margin-bottom:10px;
        margin-left:20px;
        padding:10px;
        font-style:bold;
        
        color:white;
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
    .topics
    {
        margin-top:4rem;
        padding:10px;
        font-size:20px;
        font-weight:bold;
        text-decoration:none;
        background-color:lightgrey;
        width:fit-content;
        border-radius:5px;
        
    }
    a
    {
        text-decoration:none;
    }
    a:hover
    {
        border-radius:5px;
    }
    .main
    {
        max-width: 100vw;
        border: 1px solid grey;
        padding: 10px;
        margin-left:20px;
        padding:10px;
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
    }
    .topic_box
    {
        background-color:whitesmoke;
        height:7rem;
        width:7rem;
        margin:30px;
        padding:30px;
        text-align:center;
        color:black;
        font-weight:bold;
        border: 1px solid #ccc; 
    }
    .view_topics
    {
        display: flex; 
        flex-wrap: wrap;
    }
</style>
<body>
<div class="main">
    <table border="1">
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
                <?php echo $row_view['project_name'] ;?>
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
            <!-- Main tasks or topics -->
            <div class="topics">
                <a href="../task_mgmt/create_main_task.php?project_id=<?php echo $project_id; ?>">Create Main Task | Topics</a>
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

    <!-- Fetch Topics | Main Tasks -->
    <div class="taskname">
    <center>
        <?php
        // include 'dbconnect.php';
        // $cat_id = $_GET['id'];
        $sql = "SELECT * FROM todo_c where project_id=$project_id";
        $result_task = mysqli_query($conn, $sql);
        $num_topic = mysqli_num_rows($result_task);
        
        if ($num_topic > 0) {
            
            while ($row = mysqli_fetch_assoc($result_task)) {
                $fetched_main_task_id=$row['Id'];
                $fetched_Topic_name=$row['name'];
                //Box for choosing the Main Tasks | Topics
                echo "<a href='../task_mgmt/sub_task_list.php?main_task_id=".$fetched_main_task_id."&project_id=".$project_id."'>
                <div class='view_topics'>";
                echo "<div class='topic_box'>";
                echo "<p>" .$fetched_Topic_name. "</p>";
                ?>
                <!-- <a href="../Assignment/userAssignMainTask.php?project_id=<?php echo $project_id; ?>" id="assign_users">Assign user</a> -->
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
