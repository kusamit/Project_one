<html>
    <head>
        <title>Create Main Task | Topics</title>
        <style>

        </style>
    </head>
    <body>
   
    <form action="" method="POST">
       <p>Create Main Task | Topics</p> 
        <label for="topic">Name of Topic</label><br>
        <label for="w_topic"><input type="text" name="task" placeholder="Name of Tasks" required id="task_name"></label><br>
        <label for="Assign">Assign to User</label>
        <label for="Assign_user"><?php include '../Assignment/userAssignMainTask.php';?></label><br>
        <label for="submit"><input type="submit" value="Create" name="create" id="submit"></label>
        </form>
    <?php
            $project_id = $_GET['project_id'];
            include 'dbconnect.php';
            if(isset($_POST['create']))
            {
                $create=$_POST['task'];
                $query="INSERT INTO todo_c (name,project_id) values ('$create','$project_id') ";
                $check_duplicate_query = "SELECT * FROM todo_c WHERE name='$create'";
                $check_duplicate_result = mysqli_query($conn, $check_duplicate_query);

                if($check_duplicate_result->num_rows > 0)
                {
                    echo "This username already exists!";
                }
                else{
                    $result=mysqli_query($conn,$query);
                    echo $create;
                    echo "  as Main Task | Topics is Created!";
                }
            }
    ?>
        
       
    </body>
</html>