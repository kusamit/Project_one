<html>
    <head>
        <title>Create todo</title>
        <style>
            body{
                background-color:aqua;
                text-align:center;
                align-items:center;
            }
            form{margin:5rem;
                text-align:center;
                background-color:#0043917a;
                border-radius:20px;
                width:20%; 
            }
            input{
                margin-top:10px;
            }
            p{
                font-size:20px;
                color:white;
            }
        </style>
    </head>
    <body>
   
    <form action="" method="POST">
       <p>Create Tasks</p> 
        <input type="text" name="task" placeholder="Name of Tasks" required id="task_name"><br>
        <input type="submit" value="Create" name="create" id="submit">
        <button style="width:10%; margin:10px;">
            <a href="choose_todo.php">Choose ToDo</a>
        </button>
        </form>
    <?php
            include 'dbconnect.php';
            if(isset($_POST['create']))
            {
                $create=$_POST['task'];
                $query="INSERT INTO todo_c (name) values ('$create') ";
                $result=mysqli_query($conn,$query);
                if($conn)
                {
                    echo "ToDo is Created! Choose your ToDo";
                    
                }
                else{
                    echo "error";
                }
            }
    ?>
        
       
    </body>
</html>