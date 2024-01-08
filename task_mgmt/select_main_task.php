<html>
    <head>
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
        </style>
    </head>
    <body>
    <form action="" method="POST">
        <b>Choose Your TODO</b>  <br>
        <input type="text" name="choosetodo" required ><br>
        <input type="submit" value="Choose TODO" name="c_todo" style="width:10%; margin:10px;" >
        </form>
         <!-- choose ToDO -->
         <?php
            include 'dbconnect.php';
            session_start();
            if(isset($_POST['c_todo']))
            {
                $c=$_POST['choosetodo'];
                $query="SELECT * FROM todo_c WHERE name='$c'";
                $result=mysqli_query($conn,$query);
                $num=mysqli_num_rows($result);
                if($num)
                {
                    while($row=mysqli_fetch_assoc($result))
                    {
                        echo "ToDo Name<br>" .$row['name']. "";
                        $_SESSION['todoname']=$row['name'] ;
                        
                        header("Location:sub_task_list.php?id=".$row["Id"]);
                    }
                }
            }
    ?>
    </body>
</html>