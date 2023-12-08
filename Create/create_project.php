<?php
include 'session_create.php';
?>
<html>
    <head>
        <title>
            Department
        </title>
        <link rel="stylesheet" href="../css/creation.css">
    </head>
    <body>
    <div class="head">
            <h1>Project Management System</h1>
        </div>
        <div class="nav">

        </div>
            <div class="project_creation">
            <h3>Create New Project</h3>
                <form action="" method="POST" id="formp">
                    
                    Project Name <br>
                    <span><input type="text" name="project" id="project" required></span><br>
                    Choose File <br>
                    <span><input type="file" name="file" id="project_file" required></span><br>
                    Details <br>
                    <span><textarea name="message" id="project" cols="" rows=""></textarea></span><br><br>
                    <span><input type="submit" value="Create" name="submit" id="project_smt"></span> 
                    <br><br><br>
                    <div class="phpproject">
                       <!-- php here -->
                       <?php
                        include '../dbconnect/dbconnect.php';
                        if(isset($_POST["submit"]))
                        {
                            $project_name=$_POST["project"];
                            $project_query="INSERT INTO project (project_name)
                            VALUES ('$project_name')";
                            $result=mysqli_query($conn,$project_query);
                            if($result)
                            {
                               echo "$project_name Project Created Sucessfully...!!";
                            }
                            else
                            {
                                echo "Error to create the Project";
                            }
                        }
                        ?>
                    </div>
                </form>
                    
            </div>
        
    </body>
</html>