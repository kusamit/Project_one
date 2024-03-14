<center>
    <?php
        // include 'dbconnect.php';
        $sql = "SELECT * FROM main_task where project_id=$project_id";
        $result_task = mysqli_query($conn, $sql);
        $num_topic = mysqli_num_rows($result_task);
        if ($num_topic > 0) 
        {
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
                            {
                        ?>
                                <a href="../task_mgmt/delete_main_task.php?id=<?php echo $fetched_main_task_id?>&user_id=<?php echo $fetched_assigned_userId;?>&project_id=<?php echo $project_id;?>" class="action_UD">Delete</a>
                        <?php
                            }
                        ?>
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