    <?php
        if($userType== "admin" || $userType== "foreman" || $userType=="user")
        { ?>
            <div class="mainhead">
                <table border="0">
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
                        <h3 class="p_n">
                                <?php 
                                echo $fetched_project_name ;
                                ?>
                            </h3>
                            <?php if($userType=="user"){?>
                        <h3> Project Name </h3>
                        <?php }
                        else
                        { ?>
                            <h3 class="p">Project Name </h3>
                        <?php } ?>   
                        </div> 
                    </div>
                </table>
            </div>
        <?php
        }?>