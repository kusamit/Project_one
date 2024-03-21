<?php
session_start();
include '../dbconnect/dbconnect.php';
$userType= $_SESSION["user_type"];
// echo $userType;
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
        { 
    ?>
        <div class="main">
            <table border="0">
                <!-- fetching project name and details      -->
                <div class="project_info">
                    <?php
                        if (isset($_GET['id'])) 
                        {
                            $project_id = $_GET['id'];
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
                                <h4 class="p_n"> <?php echo $row_view['project_name'] ;?> </h4>
                            </div>
                        <!-- Project Details HTML -->
                        <div id="project_details">
                            <div id="details">
                                Project Details
                            </div>
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
                                    <?php 
                                        if($fetched_file_type==1){ ?>
                                        <a class="imgpdf" href="fullimg.php?url=<?php echo $row_view['file'] ; ?>?type=<?php echo $fetched_file_type; ?>">
                                        <img style="height:10rem; width:7rem;" src="<?php echo $row_view['file'] ; ?>"><p id="view_file">View Image</p>
                                        </a>
                                    <?php 
                                        } 
                                        elseif($fetched_file_type==2)
                                        {
                                    ?>
                                        <a class="imgpdf" href="fullpdf.php?url=<?php echo $row_view['file'] ; ?>?type=<?php echo $fetched_file_type; ?>">
                                        <embed style="height:10rem; width:7rem;" src="<?php echo $row_view['file']; ?>" type="application/pdf" /><p id="view_file">View PDF</p>
                                        </a>
                                    <?php 
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="assign_user">
                            <a href="../Assignment/assigned_user.php?p_id=<?php echo $project_id; ?>" id="assign_user">Assign Users</a>
                            <a href="../Assignment/Assignedforeman.php?p_id=<?php echo $project_id; ?>" id="assign_foreman">Assign Foreman</a> 
                            <!-- <a href="./deleteproject.php?p_id=<?php echo $project_id; ?>" id="assign_foreman">Delete Project</a> -->
                            <!-- <a href="./updateproject.php?p_id=<?php echo $project_id; ?>" id="assign_foreman">Update Project</a> -->
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
                {
            ?>
                    <div class="topics">
                        <a href="../task_mgmt/create_main_task.php?p_id=<?php echo $project_id; ?>">Create Main Task | Topics</a>
                    </div>
            <?php
                }
            ?>
            
            <div class="topics_View_nav">
                <p Class="">Main Task | Topics</p>
            </div>
            <!-- Fetch Topics | Main Tasks -->
            <div class="taskname">
            <?php
                include "./view_topic.php";   //Topics | Main Tasks View
            ?>
            </div>

        </div> 
    <?php }
    ?>
</body>
</html>