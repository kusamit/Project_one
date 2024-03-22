    <?php
        if($userType== "admin" || $userType== "foreman" || $userType=="user")
        { ?>
            <div class="main">
                <table border="1">
                    <!-- fetching project name and details      -->
                    <div class="project_info">
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
                            $fetched_project_name=$row_view['project_name'];
                        ?>
                        <!-- View project Name and Details HTML -->
                        <div id="project_name">
                            <?php if($userType=="user"){?>
                        <h4 class="p">Project Name <a href="../project/project_details.php?user_type=<?php echo $userType; ?>&id=<?php echo $project_id ?>&user_id=<?php echo $user_admin_id ?>" class="back_btn">Back</a></h4>
                        <?php }
                        else
                        { ?>
                            <h4 class="p">Project Name <a href="../project/project_details.php?user_type=<?php echo $userType; ?>&id=<?php echo $project_id ?>" class="back_btn">Back</a></h4>

                        <?php } ?>    
                        
                        <h4 class="p_n">
                                <?php 
                                echo $fetched_project_name ;
                                ?>
                            </h4>
                        </div> 
                    </div>
                </table>
            </div>
        <?php
        }?>
        <hr>