<?php
session_start();
include '../dbconnect/dbconnect.php';
$userType= $_SESSION["user_type"];
$user_admin_id=$_SESSION['Login_session'];
// echo $userType;
include '../persistLogin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/project.css">
    <link rel="stylesheet" href="../css/interface.css">
</head>
<body>
<?php
if($userType == "admin")
{?>
    <?php 
        include '../interface_nav.php'; //top nav
    ?>
        <!-- Create project -->
        <center><h3>Create New Project</h3></center>
            <div id="project_creation">
                <form action="" method="POST" id="formp" enctype="multipart/form-data">
                    
                    <span>Project Name</span>
                    <span><input type="text" name="project" id="project" required class="p_create"></span>
                    <span>File Type</span>
                    <span><select name="f_type" class="p_create">
                        <option value="1">image</option>
                        <option value="2">pdf</option>
                    </select></span>
                    <span><input type="file" name="file" id="project_file"  class="p_create"></span>
                    <span>Cost</span> <span>
                    <input type="number" name="cost" class="p_create"></span>
                    <span>Deadline</span>
                    <span><input type="datetime-local" name="dt" id="" class="p_create" required></span>
                    <span>Details</span>
                    <span><textarea name="p_details" id="project" cols="" rows="" class="p_create"></textarea></span><br><br>
                    <span><input type="submit" value="Create" name="submit" id="submit_project" ></span> 
                </form>
            <!-- </div> -->
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
                            $deadline=$_POST['dt'];
                            $project_query="INSERT INTO project (project_name,file_type,project_details,cost,file,deadline)
                            VALUES ('$project_name','$file_type','$project_details','$cost','$folder','$deadline')";
                            $result=mysqli_query($conn,$project_query);
                            if($result)
                            {
                            //    echo "$project_name Project Created Sucessfully...!!";
                            echo "<script>
                            alert('project has been created successfully');
                            </script>";
                            header("Refresh:0;url='../interface.php'");
                            // window.location.href = '../interface.php';
                            // header('Location: ../interface.php');
                            }
                            else
                            {
                                echo "Error to create the Project";
                            }
                        }
                        ?>
                </div> 
                    </div>

<?php        
}
else
{
    echo "Access Forbidden";
}
?>

</body>
</html>
