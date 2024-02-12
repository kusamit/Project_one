<html>
    <head>
        <title>Create Main Task | Topics</title>
        <style>

        </style>
    </head>
    <body>
   
    <form action="" method="POST">
       <p>Create Main Task | Topics</p> 
        <input type="text" name="task" placeholder="Name of Tasks" required id="task_name"><br>
        <input type="submit" value="Create" name="create" id="submit">
        <button style="width:10%; margin:10px;">
            <a href="select_main_task.php">Choose ToDo</a>
        </button>
        </form>
    <?php
            $project_id = $_GET['project_id'];
            include 'dbconnect.php';
            if(isset($_POST['create']))
            {
                $create=$_POST['task'];
                $query="INSERT INTO todo_c (name,project_id) values ('$create','$project_id') ";
                $result=mysqli_query($conn,$query);
                if($conn)
                {
                    echo $create;
                    echo "  as Main Task | Topics is Created!";
                    
                }
                else{
                    echo "error";
                }
            }
    ?>
        
       
    </body>
</html>