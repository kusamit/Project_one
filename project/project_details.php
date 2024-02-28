<?php
session_start();
include '../dbconnect/dbconnect.php';
$userType= $_SESSION["user_type"];
echo $userType;
include '../persistLogin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/project_details.css">
</head>
<body>
    <?php
        if($userType== "admin" || $userType== "foreman" || $userType== "user")
        { ?>
            <div class="main">
                <table border="0">
                    <!-- fetching project name and details      -->
                    <div class="project_info">
                        <?php
                            if (isset($_GET['id'])) {
                                $project_id = $_GET['id'];
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
                            <h4 class="p">Project Name  <a href="../interface.php" class="back_btn">Back</a><br>
                            <h4 class="p_n">
                                <?php echo $row_view['project_name'] ;?>
                            </h4>
                        </div>
                        <!-- Project Details HTML -->
                        <div id="project_details">
                            <div id="details">
                                Project Details
                            </div>
                            <!-- <div>
                                <a href="" class="Assign">Assign</a>
                            </div> -->
                        </div>
                    </div>  
                    <div class="info_flex">
                    <div class="info_body">
                        <div class="detailed_info_left">
                                    <!-- details_Info -->
                            <div id='msg'>
                                
                                <?php 
                                    if(!$fetched_project_details)
                                    {
                                        echo "No Descriptions Available to this Project";
                                    }
                                    else
                                    {
                                        echo $fetched_project_details;
                                    }
                                    
                                ?>
                            </div>
                        </div>
                        <!-- sub details and files right side -->
                        <div class="right">
                            <div id="file">
                                <div id="project_file">
                                    <?php if($fetched_file_type==1){ ?>
                                    <a class="imgpdf" href="fullimg.php?url=<?php echo $row_view['file'] ; ?>?type=<?php echo $fetched_file_type; ?>">
                                    <img style="height:10rem; width:7rem;" src="<?php echo $row_view['file'] ; ?>"><p id="view_file">View Image</p>
                                    </a>
                                    <?php } elseif($fetched_file_type==2){?>
                                    <a class="imgpdf" href="fullpdf.php?url=<?php echo $row_view['file'] ; ?>?type=<?php echo $fetched_file_type; ?>">
                                    <embed style="height:10rem; width:7rem;" src="<?php echo $row_view['file']; ?>" type="application/pdf" /><p id="view_file">View PDF</p>
                                    </a>
                                    <?php 
                                    }?>
                                </div>
                            </div>
                        </div>
                                </div>
                        <div class="assign_user">
                            <?php
                            if(!($userType=="user"))
                            {?>
                                <a href="../Assignment/assigned_user.php?p_id=<?php echo $project_id; ?>" id="assign_user">Assign Users</a>
                            <?php
                            }?>
                            <?php
                            if(!($userType=="foreman" || $userType=="user") )
                            {?>
                                <a href="../Assignment/foremanAssignProject.php?p_id=<?php echo $project_id; ?>" id="assign_foreman">Assign Foreman</a>
                            <?php
                            }?>
                            
                        <div>
                        </div>
                        <!-- closing of project info php -->
                    <?php
                    }
                    ?>
                </table>
            <!-- Main tasks or topics -->
            <?php
            if(!($userType=="user"))
            {?>
            <div class="topics">
                <a href="../task_mgmt/create_main_task.php?project_id=<?php echo $project_id; ?>">Create Main Task | Topics</a>
            </div>
            <?php
            }?>
            
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
                    while ($row_task = mysqli_fetch_assoc($result_task)) 
                    {
                        $fetched_main_task_id = $row_task['Id'];
                        $fetched_Topic_name = $row_task['name'];
                        $fetched_topic_deadline = $row_task['deadline'];
                        $fetched_assigned_userId = $row_task['user_id'];
                        // to fetch name of the assigned user in the topic
                        $sql_user = "SELECT * FROM users where id=$fetched_assigned_userId";
                        $result_user = mysqli_query($conn, $sql_user);
                        $num_user = mysqli_num_rows($result_user);
                        if ($num_user > 0) 
                        {
                            while ($row_user = mysqli_fetch_assoc($result_user)) 
                            {
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
                            <?php
                            // if(!($userType=="user"))
                            // {?>
                            <a href="../task_mgmt/update_main_task.php?id=<?php echo $fetched_main_task_id?>&user_id=<?php echo $fetched_assigned_userId;?>&project_id=<?php echo $project_id;?>" class="action_UD">Update</a>
                            <?php
                            // }?>
                            <?php
                            if(!($userType=="foreman" || $userType=="user"))
                            {?>
                                <a href="../task_mgmt/delete_main_task.php?id=<?php echo $fetched_main_task_id?>&user_id=<?php echo $fetched_assigned_userId;?>&project_id=<?php echo $project_id;?>" class="action_UD">Delete</a>
                            <?php
                            }?>
                            <!-- <a href="#3" class="action_UD">Completed</a> -->
                        </div>
                        <?php
                        echo "</div>";
                    }

                    echo "</div>";
                } 
                else 
                {
                    echo "No records found.";
                 }
            ?>
            </center>
            </div>

        </div> 
    <?php }
    ?>
</body>
</html>