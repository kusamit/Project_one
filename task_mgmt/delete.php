<?php
                    include 'dbconnect.php';
                    $id = $_GET['id'];
                    $main_task_id = $_GET['main_task_id'];
                    $project_id = $_GET['project_id'];
                        $query="DELETE FROM sub_task_mgmt where Id=$id";
                        $result=mysqli_query($conn,$query);
                        if($result)
                        {
                            header('Location: sub_task_list.php?main_task_id='. $main_task_id.'&project_id='.$project_id);
                            
                        }
                        else
                        {
                            echo "error";
                        }
                 ?>