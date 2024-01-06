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
                /* border:5px solid blue; */
                border-radius:20px;
                padding:40px;
                
            }
            input{
                margin-top:10px;
                width:40%;
                height:5%;
            }
            button,a{
                background-color:white;
                color:black;
                border:0;
                padding:5px;
                text-decoration:none;
                
            }
            p{
                font-size:20px;
                color:white;
            }
        </style>
    </head>
    <body>
   
    <form action="" method="POST">
       <p>Create ToDo Category</p> 
        <input type="text" name="createtodo" required ><br>
        <input type="submit" value="Create" name="create" style="width:10%; margin:10px;">
        <button style="width:10%; margin:10px;">
            <a href="choose_todo.php">Choose ToDo</a>
        </button>
        </form>
    <?php
            include 'dbconnect.php';
            if(isset($_POST['create']))
            {
                $create=$_POST['createtodo'];
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