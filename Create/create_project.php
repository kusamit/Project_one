<?php
include 'session_create.php';
?>
<html>
    <head>
        <title>
            Department
        </title>
        <!-- <link rel="stylesheet" href="../css/creation.css"> -->
    </head>
    <body>
    <div class="head">
            <h1>Project Management System</h1>
        </div>
        <div class="nav">

        </div>
            <div class="project_creation">
            <h3>Create New Project</h3>
                <form action="" method="POST" id="formp" enctype="multipart/form-data">
                    
                    Project Name <br>
                    <span><input type="text" name="project" id="project" required></span><br>
                    File Type
                    <br>
                    <span><select name="f_type" id="">
                        <option value="1">image</option>
                        <option value="2">pdf</option>
                    </select></span>
                    <span><input type="file" name="file" id="project_file" required></span><br>
                    Cost <br><span><input type="number" name="cost" id=""></span><br>
                    Details <br>
                    <span><textarea name="p_details" id="project" cols="" rows=""></textarea></span><br><br>
                    <span><input type="submit" value="Create" name="submit" id="project_smt"></span> 
                    <br><br><br>
                    <div class="phpproject">
                       <!-- php here -->
                       <?php
                        include '../dbconnect/dbconnect.php';
                        if(isset($_POST["submit"]))
                        {
                            $project_name=$_POST["project"];
                            $file_type=$_POST['f_type'];
                            $project_details=$_POST['p_details'];
                            $cost=$_POST['cost'];
                            // $p_file=$_POST['file'];
                            $file=$_FILES['file']['name'];
                            $temp=$_FILES['file']['tmp_name'];
                            $folder='../project/file/'.$file;
                            move_uploaded_file($temp,$folder);
                            $project_query="INSERT INTO project (project_name,file_type,project_details,cost,file)
                            VALUES ('$project_name','$file_type','$project_details','$cost','$folder')";
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