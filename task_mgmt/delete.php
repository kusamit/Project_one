<?php
                    include 'dbconnect.php';
                    $id = $_GET['id'];
                    $cat_id = $_GET['cat_id'];
                        $query="DELETE FROM list_msg where Id=$id";
                        $result=mysqli_query($conn,$query);
                        if($result)
                        {
                            header('Location: ./sub_task_list.php?id='.$cat_id);
                            
                        }
                        else
                        {
                            echo "error";
                        }
                 ?>